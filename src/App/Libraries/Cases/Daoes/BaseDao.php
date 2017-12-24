<?php
namespace App\Libraries\Cases\Daoes;
use App\Globals\Bases\BaseSingle;
use App\Helpers\CFileHelper;
use App\Helpers\CStringHelper;
use App\Libraries\Caching\Dependencies\CFileCacheDependency;
use Phalcon\Db;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/19
 * Time: 14:48
 *
 * Class BaseDao
 * @package App\Libraries\Cases\Daoes
 */
abstract class BaseDao extends BaseSingle
{

    /**
     * 从数据库获取一个数据
     * @param string $sql       SQL查询语句
     * @return mixed            单个数据,如果无数据则返回false
     * @return bool
     */
    public function fetchOne($sql)
    {
        $data = false;
        $rows = $this->db->fetchOne($sql, Db::FETCH_NUM);
        if($rows) $data = $rows[0];
        return is_null($data) ? false : $data ;
    }

    /**
     * 获取数据，因为有时需要先查出数据再更新
     * @param string $sql
     * @param int $mode         数据结构方式:默认关联数据方式
     * @return array
     */
    public function fetchRow($sql, $mode=Db::FETCH_ASSOC)
    {
        $rows = $this->db->fetchOne($sql, $mode);
        return $rows ? $rows : array();
    }

    /**
     *从数据库获取多条记录数据
     * @param string $sql       SQL查询语句
     * @param int $mode         数据结构方式:默认关联数据方式
     * @return array|boolean    一条记录数据,如果无数据则返回false
     */
    public function fetchAll($sql, $mode=Db::FETCH_ASSOC)
    {
        $records = $this->db->fetchAll($sql, $mode);
        return $records ? $records:array();
    }


    /**
     * 更新缓存依赖
     * @param string|array $aCacheDependencyFile    一组依赖文件名称--表名称
     * @param mixed $identity                       标识，可以是登陆用户id
     * @return boolean                              更新成功返回true,否则返回false
     */
    public function updateCacheDependency($aCacheDependencyFile, $identity=null)
    {
        if(!is_array($aCacheDependencyFile))
        {
            $aCacheDependencyFile  = array($aCacheDependencyFile);
        }

        return $this->mappingCreateCacheDependency($aCacheDependencyFile, $identity);
    }


    /**
     * 通过文件名获取缓存文件依赖对象--保存在缓存文件依赖目录:selete操作使用
     * @param string    $filename           文件名
     * @param mixed     $identity           身份标识
     * @return CFileCacheDependency         缓存文件依赖对象
     */
    public function getCacheDependency($filename, $identity=null)
    {
        $dir = $this->getCacheDependencyDir($identity);
        $stringHelper = CStringHelper::getInstance();

        $filepath = $dir.$stringHelper->cryptString($filename);
        if(!is_file($filepath))
            $this->createCacheDependency($filename, $identity);

        return new CFileCacheDependency($filepath);
    }


    /**
     * 新建缓存文件依赖文件--保存在缓存文件依赖目录:create,update,delete操作使用
     * 在以上操作中，可以生成多个缓存依赖文件给不同的查询使用
     * @param string $filename      文件名
     * @param mixed $identity       标识，可以是登陆用户id
     * @return boolean              生成文件或是修改文件的时间成功返回true,否则返回false
     */
    private function createCacheDependency($filename, $identity=null)
    {
        $stringHelper = CStringHelper::getInstance();
        $fileHelper = CFileHelper::getInstance();

        $dir = $this->getCacheDependencyDir($identity);
        $filename = $stringHelper->cryptString($filename);
        $filepath = $dir.$filename;
        $toggle =  (bool)$fileHelper->createFile($filepath, microtime());
        return $toggle;
    }

    /**
     * 批量生成缓存文件依赖文件
     * @param array $aFileDependency    文件名列表
     * @param mixed $identity           标识，可以是登陆用户id
     * @return boolean                  成功返回true,否则返回false
     */
    private function mappingCreateCacheDependency(array $aFileDependency, $identity=null)
    {
        $toggle = false;
        if($aFileDependency)
        {
            foreach ($aFileDependency as $fileDependency)
            {
                $toggle = $this->createCacheDependency($fileDependency, $identity);
                if(!$toggle)break;
            }
        }
        return $toggle;
    }

    /**
     * 获取缓存文件依赖目录名称
     * @param mixed   $identity         登陆用户id
     * @return string                   目录名称
     */
    private function getCacheDependencyDir($identity=null)
    {
        $dir = DEPENDENCY_CACHE_DIR;
        if($identity) $dir.= $identity.'/';

        $fileHelper = CFileHelper::getInstance();
        $fileHelper->createDir($dir);

        return $dir;
    }
}
