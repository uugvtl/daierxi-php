<?php
namespace App\Libraries\Daoes;
use App\Helpers\FileHelper;
use App\Helpers\StringHelper;
use App\Libraries\Caching\Dependencies\CFileCacheDependency;
use Phalcon\Cache\BackendInterface;
use phalcon\Config;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/19
 * Time: 14:48
 *
 * Class QueryDao
 * @package App\Libraries\Cases
 * @property Config $config
 */
class CacheDao extends BaseDao
{
    /**
     * 缓存时间，单位为秒，例如缓存30秒，设置此值为30; 0表示永不过期。
     * @var int
     */
    private $lifetime = 172800;

    /**
     * 缓存时间，单位为秒，例如缓存30秒，设置此值为30; 0表示永不过期。
     * @var int
     */
    private $shorttime = 180;

    /**
     * 缓存助手实例
     * @var BackendInterface
     */
    private $cacheInstance;


    public function init(...$args)
    {
        $this->cacheInstance = $args[0];
        return $this;
    }


    /**
     * 设置缓存
     * @param string $key       缓存名称
     * @param mixed $data       缓存数据，可以被序列化的才行
     * @param int $lifetime     过期时间，0为使用默认过期时间
     * @return boolean          保存成功返回true, 否则返回false
     */
    public function saveCache($key, $data, $lifetime=0)
    {
        if(empty($lifetime))
            $lifetime=$this->lifetime;

        $toggle = $this->cacheInstance->save($key, $data, $lifetime);
        $toggle && $this->setCacheFileMode($key);

        return $toggle;
    }


    /**
     * 获取缓存
     * @param string $key       缓存名称
     * @return array            保存成功返回true, 否则返回false
     */
    public function obtainCache($key)
    {
        $data=null;
        if($this->cacheInstance->exists($key)){
            $data = $this->cacheInstance->get($key);
        }
        return $data;

    }


    /**
     * 删除指定键名的缓存
     * @param string $key       缓存键名
     * @return boolean          删除成功返回true, 否则返回false
     */
    public function deleteCache($key)
    {
        return $this->cacheInstance->delete($key);
    }



    /**
     * 删除指定的缓存目录
     * @param string $className     缓存目录名--一般来说是一个类名：例如stores目录下面的类
     * @return boolean              删除成功返回true, 否则返回false
     */
    public function clearCache($className)
    {
        $stringHelper = StringHelper::getInstance();
        $className  = $stringHelper->cryptString($className);

        $aOptions   = $this->cacheInstance->getOptions();
        $cacheDir   = $aOptions['cacheDir'].$className.'/';

        $toggle = false;
        if(is_dir($cacheDir))
        {
            $fileHelper = FileHelper::getInstance();
            $fileHelper->removeDirectory($cacheDir);
            $toggle = true;
        }

        return $toggle;
    }

    /**
     * 获取有缓存依赖的缓存数据
     * @param string $key                                                   缓存键名
     * @param CFileCacheDependency[]|CFileCacheDependency    $dependency    文件缓存依赖对象
     * @param mixed $callback                                               数据源--回调函数
     * @param array $parameter                                              回调函数使用的参数
     * @return mixed                                                        数据库查询数据
     */
    public function getCache($key, $dependency, $callback, $parameter=array())
    {
        $data = null;

        if($this->config->path('cache.enable'))
        {
            if(is_array($dependency))
            {
                $data = $this->getMultiKeyCacheData($key, $dependency, $callback, $parameter);
            }
            else
            {
                if( $dependency instanceof CFileCacheDependency)
                {
                    $timestamp = $this->getCacheDependencyTimestamp($dependency);
                    $data = $this->getSingleKeyCacheData($key, $timestamp, $callback, $parameter);
                }
            }
        }
        else
        {
            $data = call_user_func_array($callback, $parameter);
        }

        return $data;
    }


    /**
     * 获取以数据库查询数据为基础的缓存--单项数据
     * @param string                                        $sql			SQL语句
     * @param CFileCacheDependency[]|CFileCacheDependency   $dependencies     文件缓存依赖对象
     * @return mixed                                                        数据库查询数据
     */
    public function getCacheOne($sql, $dependencies)
    {
        $data = null;

        if($this->config->path('cache.enable'))
        {
            if(is_array($dependencies))
            {
                $data = $this->getMultiCacheData($sql, $dependencies, 'fetchOne');
            }
            else
            {
                if( $dependencies instanceof CFileCacheDependency)
                {
                    $timestamp = $this->getCacheDependencyTimestamp($dependencies);
                    $data = $this->getSingleCacheData($sql, $timestamp, 'fetchOne');
                }

            }

        }
        else
        {
            $data = $this->fetchOne($sql);
        }


        return $data;

    }

    /**
     * 获取以数据库查询数据为基础的缓存--一条数据
     * @param string                        $sql			SQL语句
     * @param CFileCacheDependency[]|CFileCacheDependency    $dependency     文件缓存依赖对象
     * @return mixed                                        数据库查询数据
     */
    public function getCacheRow($sql, $dependency)
    {
        $row = [];

        if($this->config->path('cache.enable'))
        {
            if(is_array($dependency))
            {
                $row = $this->getMultiCacheData($sql, $dependency, 'fetchRow');
            }
            else
            {
                if( $dependency instanceof CFileCacheDependency)
                {
                    $timestamp = $this->getCacheDependencyTimestamp($dependency);
                    $row = $this->getSingleCacheData($sql, $timestamp, 'fetchRow');
                }
            }
        }
        else
        {
            $row = $this->fetchRow($sql);
        }

        return $row;

    }

    /**
     * 获取以数据库查询数据为基础的缓存--数据集
     * @param string                        $sql			SQL语句
     * @param array|CFileCacheDependency    $dependency     文件缓存依赖对象
     * @return mixed                                        数据库查询数据
     */
    public function getCacheAll($sql, $dependency)
    {
        $records = null;

        if($this->config->path('cache.enable'))
        {
            if(is_array($dependency))
            {
                $records = $this->getMultiCacheData($sql, $dependency, 'fetchAll');
            }
            else
            {
                if( $dependency instanceof CFileCacheDependency)
                {
                    $timestamp = $this->getCacheDependencyTimestamp($dependency);
                    $records = $this->getSingleCacheData($sql, $timestamp, 'fetchAll');
                }

            }
        }
        else
        {
            $records = $this->fetchAll($sql);
        }

        return $records ? $records : array();
    }

    /**
     * 获取依赖文件的取得文件修改时间
     * @param CFileCacheDependency $dependency          缓存依赖对象
     * @return int                                      时间戳
     */
    protected function getCacheDependencyTimestamp(CFileCacheDependency $dependency=null)
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
     * 获取缓存数据--只有一个缓存依赖
     * @param string    $key			                SQL语句
     * @param int       $timestamp                      时间戳
     * @param string    $fetch                          本类的方法名 fetchOne, fetchRow, fetchAll
     * @return mixed                                    缓存数据
     */
    protected function getSingleCacheData($key, $timestamp, $fetch)
    {
        $data = null;

        $cache = $this->cacheInstance;


        if($cache->exists($key))
        {

            $cacheData = $cache->get($key);

            if($cacheData)
            {
                $cachetime = $cacheData['timestamp'];

                if($timestamp!=$cachetime)
                {
                    $res = call_user_func(array($this, $fetch), $key);
                    if(!empty($res))
                    {
                        $gzdeflate = serialize($res);

                        $cacheData = array(
                            'data'      =>$gzdeflate,
                            'timestamp' =>$timestamp
                        );

                        $cache->save($key, $cacheData, $this->lifetime);
                        $this->setCacheFileMode($key);
                    }
                    else
                    {
                        $cacheData = [];
                        $cache->delete($key);
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
            $res = call_user_func(array($this, $fetch), $key);

            if($res)
            {
                $gzdeflate = serialize($res);

                $cacheData = array(
                    'data'      =>$gzdeflate,
                    'timestamp' =>$timestamp
                );
                $data = $res;

                $cache->save($key, $cacheData, $this->lifetime);
                $this->setCacheFileMode($key);
            }
            else
            {
                $cacheData = array(
                    'data'      =>null,
                    'timestamp' =>$timestamp
                );
                $data = $res;
                $cache->save($key, $cacheData, $this->shorttime);
                $this->setCacheFileMode($key);
            }

        }

        return $data;

    }

    /**
     * 获取缓存数据--有多个缓存依赖
     * @param string                    $key            SQL语句
     * @param CFileCacheDependency[]    $dependencies    一组CFileCacheDependency对象
     * @param string                    $fetch          本类的方法名 fetchOne, fetchRow, fetchAll
     * @return mixed                                    缓存数据
     */
    protected function getMultiCacheData($key, array $dependencies, $fetch)
    {
        $data = null;

        $cache = $this->cacheInstance;/* @var $cache BackendInterface */

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
                            if(isset($multiTimestamp[$dependency->fileName]))
                            {
                                $expireTimestamp = $multiTimestamp[$dependency->fileName];
                                if($expireTimestamp!=$timestamp)
                                {
                                    $isExpire = true;
                                    break;
                                }
                            }
                        }

                        if($isExpire)
                        {
                            $res = call_user_func(array($this, $fetch), $key);
                            if(!empty($res))
                            {
                                $gzdeflate = serialize($res);

                                if($dependencies)
                                {
                                    $cacheData['multi_timestamp'] = array();
                                    foreach ($dependencies as $dependency)
                                    {
                                        $cacheData['multi_timestamp'][$dependency->fileName] =
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

            $res = call_user_func(array($this, $fetch), $key);

            if($dependencies)
            {
                $cacheData['multi_timestamp'] = array();
                foreach ($dependencies as $dependency)
                {/* @var $dependency CFileCacheDependency */
                    $cacheData['multi_timestamp'][$dependency->fileName] =
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
     * 获取缓存数据--只有一个缓存依赖:不是从SQL里面得到的数据
     * @param string $key                                   缓存键名
     * @param int $timestamp                                时间戳
     * @param string|array  $callback                       回调函数名称
     * @param array $parameter                              回调函数使用的参数
     * @return mixed                                        数据库查询数据
     */
    protected function getSingleKeyCacheData($key, $timestamp, $callback,$parameter=array())
    {
        $data = null;


        $cache = $this->cacheInstance;/* @var $cache BackendInterface */

        if ($cache->exists($key))
        {
            $cacheData = $cache->get($key);

            if($cacheData)
            {
                $cachetime=$cacheData['timestamp'];

                if($timestamp!=$cachetime)
                {
                    $res = call_user_func_array($callback, $parameter);
                    if($res)
                    {
                        $gzdeflate = serialize($res);

                        $cacheData = array(
                            'data'      =>$gzdeflate,
                            'timestamp' =>$timestamp
                        );

                        $cache->save($key, $cacheData, $this->lifetime);
                        $this->setCacheFileMode($key);
                    }
                    else
                    {
                        $cacheData = [];
                        $cache->delete($key);
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
            $res = call_user_func_array($callback, $parameter);

            if($res)
            {
                $gzdeflate = serialize($res);

                $cacheData = array(
                    'data'      =>$gzdeflate,
                    'timestamp' =>$timestamp
                );
                $data = $res;

                $cache->save($key, $cacheData, $this->lifetime);
                $this->setCacheFileMode($key);
            }
            else
            {
                $cacheData = array(
                    'data'      =>null,
                    'timestamp' =>$timestamp
                );
                $cache->save($key, $cacheData, $this->shorttime);
                $this->setCacheFileMode($key);
            }
        }

        return $data;

    }


    /**
     * 获取缓存数据--有多个缓存依赖:不是从SQL里面得到的数据
     * @param string $key                                   缓存键名
     * @param array  $dependencys                           一组CFileCacheDependency对象
     * @param string|array  $callback                       回调函数名称
     * @param array $parameter                              回调函数使用的参数
     * @return mixed                                        数据库查询数据
     */
    protected function getMultiKeyCacheData($key, array $dependencys, $callback,$parameter=array())
    {
        $data = null;

        $cache = $this->cacheInstance;/* @var $cache BackendInterface */

        $cacheData = array();

        if($cache->exists($key))
        {
            $cacheData = $cache->get($key);

            if($cacheData)
            {
                $multiTimestamp = $cacheData['multi_timestamp'];

                if($multiTimestamp)
                {
                    if($dependencys)
                    {
                        $isExpire = false;
                        foreach ($dependencys as $dependency)
                        {
                            $timestamp = $this->getCacheDependencyTimestamp($dependency);

                            //判断是否有缓存依赖过期
                            if(isset($multiTimestamp[$dependency->fileName]))
                            {
                                $expireTimestamp = $multiTimestamp[$dependency->fileName];
                                if($expireTimestamp!=$timestamp)
                                {
                                    $isExpire = true;
                                    break;
                                }
                            }
                        }

                        if($isExpire)
                        {
                            $res = call_user_func_array($callback, $parameter);
                            if($res)
                            {
                                $gzdeflate = serialize($res);

                                if($dependencys)
                                {
                                    $cacheData['multi_timestamp'] = array();
                                    foreach ($dependencys as $dependency)
                                    {
                                        $cacheData['multi_timestamp'][$dependency->fileName] =
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

            $res = call_user_func_array($callback, $parameter);

            if($dependencys)
            {
                $cacheData['multi_timestamp'] = array();
                foreach ($dependencys as $dependency)
                {
                    $cacheData['multi_timestamp'][$dependency->fileName] =
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
    protected function setCacheFileMode($key)
    {
        $fileHelper = FileHelper::getInstance();
        $cacheOption = $this->cacheInstance->getOptions();
        $cachePath = $cacheOption['cacheDir'].md5($key);
        $fileHelper->chmodFile($cachePath);
    }
}