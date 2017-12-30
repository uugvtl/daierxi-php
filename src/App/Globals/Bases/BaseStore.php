<?php
namespace App\Globals\Bases;
use App\Injecters\SqlangInjecter;
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
     * @var SqlangInjecter
     */
    private $sqlangInjecter;

    /**
     * @param SqlangInjecter $injecter
     * @return $this
     */
    final public function setSqlangInjecter(SqlangInjecter $injecter)
    {
        $this->sqlangInjecter = $injecter;
        return $this;
    }

    /**
     * @return SqlangInjecter
     */
    final public function getSqlangInjecter()
    {
        return $this->sqlangInjecter;
    }

    /**
     * 获取一组列表数据
     * @return mixed
     */
    public function getList()
    {
        $pagingLimit= $this->getPagingLimit();

        $sqlangInjecter = $this->getSqlangInjecter();

        $fieldsInstance = $sqlangInjecter->getFieldsInstance();
        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

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
        $sqlangInjecter = $this->getSqlangInjecter();

        $fieldsInstance = $sqlangInjecter->getFieldsInstance();
        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

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
        $sqlangInjecter = $this->getSqlangInjecter();

        $fieldsInstance = $sqlangInjecter->getFieldsInstance();
        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

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
        $sqlangInjecter = $this->getSqlangInjecter();
        
        $fieldsInstance = $sqlangInjecter->getFieldsInstance();
        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

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
    final protected function getPagingLimit()
    {
        $sqlangInjecter = $this->getSqlangInjecter();
        $pageSlice = $sqlangInjecter->getPageInstance();

        $stmt = '';
        if($pageSlice)
            $stmt = $pageSlice->getPagingLimit();
        return $stmt;
    }


}