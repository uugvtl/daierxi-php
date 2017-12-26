<?php
namespace App\Libraries\Caches;
use App\Libraries\Caches\Dependencies\BaseCacheDependency;
use App\Libraries\Caches\Dependencies\NotCacheDependency;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 19:02
 *
 * Class NoneCache
 * @package App\Libraries\Caches
 */
class NotCache extends BaseCache
{
    /**
     * 获取以数据库查询数据为基础的缓存--单项数据
     * @param string                        $sql			SQL语句
     * @param BaseCacheDependency[]            $dependencies   文件缓存依赖对象
     * @return mixed                                        数据库查询数据
     */
    public function getOne($sql, array $dependencies)
    {
        $data = $this->dao->fetchOne($sql);
        return $data;

    }

    /**
     * 获取以数据库查询数据为基础的缓存--一条数据
     * @param string                        $sql			SQL语句
     * @param BaseCacheDependency[]            $dependencies   文件缓存依赖对象
     * @return mixed                                        数据库查询数据
     */
    public function getRow($sql, array $dependencies)
    {
        $row = $this->dao->fetchRow($sql);
        return $row;
    }

    /**
     * 获取以数据库查询数据为基础的缓存--数据集
     * @param string                        $sql			SQL语句
     * @param BaseCacheDependency[]            $dependencies   文件缓存依赖对象
     * @return mixed                                        数据库查询数据
     */
    public function getAll($sql, array $dependencies)
    {
        $records = $this->dao->fetchAll($sql);
        return $records ? $records : array();
    }

    public function createCacheDependencies($tableNames)
    {
        $dependencies = [];
        $dependencies[] = new NotCacheDependency();
        return $dependencies;
    }


    public function updateCacheDependencies($tableNames)
    {
        return true;
    }
}