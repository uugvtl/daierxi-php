<?php
namespace App\Libraries\Caches;
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
    public function getOne($sql)
    {
        $data = $this->getDao()->fetchOne($sql);
        return $data;

    }

    public function getRow($sql)
    {
        $row = $this->getDao()->fetchRow($sql);
        return $row;
    }

    /**
     * 获取以数据库查询数据为基础的缓存--数据集
     * @param string                        $sql			SQL语句
     * @return mixed                                        数据库查询数据
     */
    public function getAll($sql)
    {
        $records = $this->getDao()->fetchAll($sql);
        return $records ? $records : array();
    }

    public function clean()
    {
        return true;
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