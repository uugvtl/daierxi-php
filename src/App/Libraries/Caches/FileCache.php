<?php
namespace App\Libraries\Caches;
use App\Helpers\FileHelper;
use App\Helpers\StringHelper;
use App\Libraries\Caches\Dependencies\BaseCacheDependency;
use App\Libraries\Caches\Dependencies\FileCacheDependency;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/19
 * Time: 14:48
 *
 * Class QueryDao
 * @package App\Libraries\Cases
 */
class FileCache extends BaseCache
{
    /**
     * 清除所有缓存
     * @return boolean              删除成功返回true, 否则返回false
     */
    public function clean()
    {
        $fileHelper = FileHelper::getInstance();
        $aOptions   = $this->$this->cache->getOptions();
        $cacheDir   = $aOptions['cacheDir'];

        $toggle = false;
        if(is_dir($cacheDir))
        {
            $fileHelper->removeDirectory($cacheDir);
            $toggle = true;
        }

        return $toggle;
    }

    /**
     * 设置缓存
     * @param string $key       缓存名称
     * @param mixed $data       缓存数据，可以被序列化的才行
     * @param int $lifetime     过期时间，0为使用默认过期时间
     * @return boolean          保存成功返回true, 否则返回false
     */
    public function set($key, $data, $lifetime=0)
    {
        $toggle = parent::set($key, $data, $lifetime);
        $toggle && $this->setCacheFileMode($key);
        return $toggle;
    }

    public function getOne($sql)
    {
        $data = null;

        if($this->config->path('cache.enable'))
        {
            $data = $this->getCacheData($sql, $this->getDependencies(), 'fetchOne');
        }
        else
        {
            $data = $this->getDao()->fetchOne($sql);
        }


        return $data;

    }

    public function getRow($sql)
    {

        if($this->config->path('cache.enable'))
        {
            $row = $this->getCacheData($sql, $this->getDependencies(), 'fetchRow');
        }
        else
        {
            $row = $this->getDao()->fetchRow($sql);
        }

        return $row;

    }

    public function getAll($sql)
    {

        if($this->config->path('cache.enable'))
        {
            $records = $this->getCacheData($sql, $this->getDependencies(), 'fetchAll');
        }
        else
        {
            $records = $this->getDao()->fetchAll($sql);
        }

        return $records ? $records : array();
    }

    public function createCacheDependencies($tableNames)
    {
        $dependencies = [];

        $dir = $this->getCacheDependencyBox();
        $stringHelper = StringHelper::getInstance();

        if(!is_array($tableNames))
        {
            $tableNames  = [$tableNames];
        }

        foreach ($tableNames as $tableName)
        {
            $filepath = $dir.$stringHelper->cryptString($tableName);
            if(!is_file($filepath))
                $this->createDependencyFile($tableName);

            $dependencies[] = new FileCacheDependency($filepath);
        }

        return $dependencies;
    }


    public function updateCacheDependencies($tableNames)
    {
        if(!is_array($tableNames))
        {
            $tableNames  = [$tableNames];
        }

        $toggle = false;
        if($tableNames)
        {
            foreach ($tableNames as $tableName)
            {
                $toggle = $this->createDependencyFile($tableName);
                if(!$toggle)break;
            }
        }
        return $toggle;

    }


    /**
     * 新建缓存文件依赖文件--保存在缓存文件依赖目录:create,update,delete操作使用
     * 在以上操作中，可以生成多个缓存依赖文件给不同的查询使用
     * @param string $filename 文件名
     * @return boolean              生成文件或是修改文件的时间成功返回true,否则返回false
     */
    private function createDependencyFile($filename)
    {
        $stringHelper = StringHelper::getInstance();
        $fileHelper = FileHelper::getInstance();

        $dir = $this->getCacheDependencyBox();
        $filename = $stringHelper->cryptString($filename);
        $filepath = $dir.$filename;
        $toggle =  (bool)$fileHelper->createFile($filepath, microtime());
        return $toggle;
    }

    /**
     * 获取缓存文件依赖目录名称
     * @return string                   目录名称
     */
    private function getCacheDependencyBox()
    {
        $dir = DEPENDENCY_CACHE_DIR;

        $fileHelper = FileHelper::getInstance();
        $fileHelper->createDir($dir);

        return $dir;
    }

    /**
     * 获取依赖文件的取得文件修改时间
     * @param BaseCacheDependency $dependency          缓存依赖对象
     * @return int                                  时间戳
     */
    private function getCacheDependencyTimestamp(BaseCacheDependency $dependency=null)
    {
        $timestamp = 0;
        if($dependency)
        {
            $dependency->reuseDependentData = true;
            if($dependency->getHasChanged())
            {
                $dependency->evaluateDependency();
            }

            $timestamp = $dependency->getDependentData();
        }

        return $timestamp;
    }




    /**
     * 获取缓存数据--有多个缓存依赖
     * @param string                    $key            SQL语句
     * @param BaseCacheDependency[]     $dependencies   一组CCacheDependency对象
     * @param string                    $fetch          本类的方法名 fetchOne, fetchRow, fetchAll
     * @return mixed                                    缓存数据
     */
    private function getCacheData($key, array $dependencies, $fetch)
    {
        $data = null;

        $cache = $this->cache;

        $cacheData = [];

        if($cache->exists($key))
        {
            $cacheData = $cache->get($key);

            if($cacheData)
            {
                $multiTimestamp = $cacheData['multi_timestamp'];

                if($multiTimestamp)
                {
                    if($dependencies)
                    {
                        $isExpire = false;
                        foreach ($dependencies as $dependency)
                        {
                            $timestamp = $this->getCacheDependencyTimestamp($dependency);

                            //判断是否有缓存依赖过期
                            if(isset($multiTimestamp[$dependency->getKey()]))
                            {
                                $expireTimestamp = $multiTimestamp[$dependency->getKey()];
                                if($expireTimestamp!=$timestamp)
                                {
                                    $isExpire = true;
                                    break;
                                }
                            }
                        }

                        if($isExpire)
                        {
                            $res = call_user_func(array($this->getDao(), $fetch), $key);
                            if(!empty($res))
                            {
                                $gzdeflate = serialize($res);

                                if($dependencies)
                                {
                                    $cacheData['multi_timestamp'] = array();
                                    foreach ($dependencies as $dependency)
                                    {
                                        $cacheData['multi_timestamp'][$dependency->getKey()] =
                                            $this->getCacheDependencyTimestamp($dependency);
                                    }
                                }

                                $cacheData['data'] = $gzdeflate;

                                $cache->save($key, $cacheData, $this->lifetime);
                                $this->setCacheFileMode($key);
                            }
                            else
                            {
                                $cacheData = [];
                                $cache->delete($key);
                            }
                        }
                    }
                }

                if(isset($cacheData['data']))
                {
                    $serialize = $cacheData['data'];
                    $data = unserialize($serialize);
                }

            }

        }
        else
        {

            $res = call_user_func(array($this->getDao(), $fetch), $key);

            if($dependencies)
            {
                $cacheData['multi_timestamp'] = array();
                foreach ($dependencies as $dependency)
                {
                    $cacheData['multi_timestamp'][$dependency->getKey()] =
                        $this->getCacheDependencyTimestamp($dependency);
                }
            }

            if($res)
            {
                $gzdeflate = serialize($res);

                $cacheData['data'] = $gzdeflate;

                $data = $res;

                $cache->save($key, $cacheData, $this->lifetime);
                $this->setCacheFileMode($key);

            }
            else
            {
                $cacheData['data'] = null;
                $cache->save($key, $cacheData, $this->shorttime);
                $this->setCacheFileMode($key);
            }

        }

        return $data;

    }

    /**
     * 设置缓存文件的*unix系统的模式
     * @param string $key   缓存键名
     * @return void
     */
    private function setCacheFileMode($key)
    {
        $fileHelper = FileHelper::getInstance();
        $cacheOption = $this->cache->getOptions();
        $cachePath = $cacheOption['cacheDir'].md5($key);
        $fileHelper->chmodFile($cachePath);
    }

}