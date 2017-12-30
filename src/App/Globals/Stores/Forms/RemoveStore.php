<?php
namespace App\Globals\Stores\Forms;
use App\Globals\Stores\FormStore;
use App\Helpers\SqlHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/8/17
 * Time: 16:18
 *
 * Class DeleteStore
 * @package App\Globals\Stores
 */
class RemoveStore extends FormStore
{

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

}