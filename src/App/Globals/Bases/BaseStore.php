<?php
namespace App\Globals\Bases;
use App\Helpers\SqlHelper;
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
     * 带事务更新
     * @return int
     */
    public function commit()
    {
        $sqlHelper = SqlHelper::getInstance();

        $sqlangInjecter = $this->getSqlangInjecter();

        $fieldsInstance = $sqlangInjecter->getFieldsInstance();
        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

        $fields     = $fieldsInstance->getFields();
        $original   = $fieldsInstance->getOriginal();

        $table = $tableInstance->getJoinTable();
        $where = $whereInstance->get();

        $sql = $sqlHelper->getUpdateString($fields, $table, $where, $original);
        $numbers = $this->cache->getDao()->commit($sql);
        $numbers && $this->cache->updateCacheDependencies($tableInstance->getTableList());
        return $numbers;
    }

    /**
     * 无事务更新--需要手动开启事务
     * @return int
     */
    public function submit()
    {
        $sqlHelper = SqlHelper::getInstance();

        $sqlangInjecter = $this->getSqlangInjecter();

        $fieldsInstance = $sqlangInjecter->getFieldsInstance();
        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

        $fields     = $fieldsInstance->getFields();
        $original   = $fieldsInstance->getOriginal();
        $table      = $tableInstance->getJoinTable();
        $where      = $whereInstance->get();

        $sql = $sqlHelper->getUpdateString($fields, $table, $where, $original);
        $numbers = $this->cache->getDao()->submit($sql);
        $numbers && $this->cache->updateCacheDependencies($tableInstance->getTableList());
        return $numbers;
    }

    /**
     * 带事务删除
     * @return int
     */
    public function remove()
    {
        $sqlHelper = SqlHelper::getInstance();

        $sqlangInjecter = $this->getSqlangInjecter();

        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

        $table = $tableInstance->getJoinTable();
        $alias = $tableInstance->getAliasTable();
        $where = $whereInstance->get();


        $sql = $sqlHelper->getDeleteString($table, $where, $alias);
        $numbers = $this->cache->getDao()->commit($sql);
        $numbers && $this->cache->updateCacheDependencies($tableInstance->getTableList());
        return $numbers;
    }

    /**
     * 无事务删除--需要手动开启事务
     * @return int
     */
    public function delete()
    {
        $sqlHelper = SqlHelper::getInstance();

        $sqlangInjecter = $this->getSqlangInjecter();

        $tableInstance  = $sqlangInjecter->getTableInstance();
        $whereInstance  = $sqlangInjecter->getWhereInstance();

        $table = $tableInstance->getJoinTable();
        $alias = $tableInstance->getAliasTable();
        $where = $whereInstance->get();

        $sql = $sqlHelper->getDeleteString($table, $where, $alias);
        $numbers = $this->cache->getDao()->submit($sql);
        $numbers && $this->cache->updateCacheDependencies($tableInstance->getTableList());
        return $numbers;
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
        return $this->cache->setDependencies($aCacheDependency)->getAll($sql);
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
        return $this->cache->setDependencies($aCacheDependency)->getOne($sql);
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
        $rows = $this->cache->setDependencies($aCacheDependency)->getRow($sql);
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
        $rows = $this->cache->setDependencies($aCacheDependency)->getOne($sql);
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