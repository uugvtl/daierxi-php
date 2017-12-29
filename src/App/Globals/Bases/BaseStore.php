<?php
namespace App\Globals\Bases;
use App\Injecters\StoreInjecter;
use App\Libraries\Caches\BaseCache;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 16/8/30
 * Time: 16:29
 *
 * Class BaseStore
 * @package App\Globals\Bases
 */
abstract class BaseStore extends BaseSingle
{
    /**
     * 操作数据的封状工具类
     * @var BaseCache
     */
    protected $cache;

    /**
     * @var StoreInjecter
     */
    private $storeInjecter;

    /**
     * @param StoreInjecter $injecter
     * @return $this
     */
    public function setStoreInjecter(StoreInjecter $injecter)
    {
        $this->storeInjecter = $injecter;
        return $this;
    }

    /**
     * @return StoreInjecter
     */
    public function getStoreInjecter()
    {
        return $this->storeInjecter;
    }

    /**
     * 获取一组列表数据
     * @return mixed
     */
    public function getList()
    {
        $pagingLimit= $this->getPagingLimit();

        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $columns= $fieldsInstance->getColumns();
        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $aCacheDependency = $this->cache->createCacheDependencies($tableInstance->getTableList());

        $orderBy = $this->cache->getDao()->getSortStmt();
        $orderBy = $orderBy ? $orderBy : $fieldsInstance->getOrderStmt();

        $groupBy = $fieldsInstance->getGroupStmt();

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where} {$groupBy} {$orderBy} {$pagingLimit};\n";
        return $this->cache->getAll($sql, $aCacheDependency);
    }


    /**
     * 获取记录总数，分于分页使用
     * @return int
     */
    public function getCount()
    {
        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $aCacheDependency = $this->cache->createCacheDependencies($tableInstance->getTableList());

        $groupBy = $fieldsInstance->getGroupStmt();

        if(empty($groupBy))
        {
            $sql = "SELECT
                        COUNT(*)
                    FROM
                        {$table}
                    WHERE
                        1=1 {$where};\n";
        }
        else
        {
            $sql = "SELECT
                        COUNT(*)
                    FROM
                    (
                        SELECT
                            COUNT(*)
                        FROM
                            {$table}
                        WHERE
                            1=1 {$where} {$groupBy}
                    ) tmp;";
        }
        return $this->cache->getOne($sql, $aCacheDependency);
    }

    /**
     * 获取一条记录数据信息
     * @return mixed
     */
    public function getRow()
    {
        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $columns= $fieldsInstance->getColumns();
        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $aCacheDependency = $this->cache->createCacheDependencies($tableInstance->getTableList());

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where};\n";
        $rows = $this->cache->getRow($sql, $aCacheDependency);
        return $rows;
    }

    /**
     * 获取一条记录数据信息
     * @return mixed
     */
    public function getOne()
    {
        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $columns= $fieldsInstance->getColumns();
        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $aCacheDependency = $this->cache->createCacheDependencies($tableInstance->getTableList());

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where};\n";
        $rows = $this->cache->getOne($sql, $aCacheDependency);
        return $rows;
    }


    /**
     * 获取分页SQL语句
     * @return string
     */
    protected function getPagingLimit()
    {
        $pageSlice = $this->getStoreInjecter()->getPageInstance();

        $stmt = '';
        if($pageSlice)
            $stmt = $pageSlice->getPagingLimit();
        return $stmt;
    }
}