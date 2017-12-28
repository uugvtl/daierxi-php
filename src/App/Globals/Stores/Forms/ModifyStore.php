<?php
namespace App\Globals\Stores\Forms;
use App\Globals\Stores\FormStore;
use App\Helpers\SqlHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/8/17
 * Time: 03:12
 *
 * Class UpdateStore
 * @package App\Globals\Stores
 */
class ModifyStore extends FormStore
{
    /**
     * 带事务更新
     * @return int
     */
    public function commit()
    {
        $sqlHelper = SqlHelper::getInstance();
        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

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

        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $fields     = $fieldsInstance->getFields();
        $original   = $fieldsInstance->getOriginal();
        $table      = $tableInstance->getJoinTable();
        $where      = $whereInstance->get();

        $sql = $sqlHelper->getUpdateString($fields, $table, $where, $original);
        $numbers = $this->cache->getDao()->submit($sql);
        $numbers && $this->cache->updateCacheDependencies($tableInstance->getTableList());
        return $numbers;
    }

}