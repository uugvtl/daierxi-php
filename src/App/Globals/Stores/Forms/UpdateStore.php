<?php
namespace App\Globals\Stores\Forms;
use App\Globals\Stores\FormStore;
use App\Helpers\SqlHelper;
use App\Libraries\Daoes\FormDao;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/8/17
 * Time: 03:12
 *
 * Class UpdateStore
 * @package App\Globals\Stores
 */
class UpdateStore extends FormStore
{

    /**
     * 只在生成成实例的时候运行一次
     */
    protected function afterInstance()
    {
        parent::afterInstance();
        $this->dao = FormDao::getInstance();
    }



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
        $numbers = $this->dao->commit($sql);
        $numbers && $this->dao->updateCacheDependency($tableInstance->getTableList());
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
        $numbers = $this->dao->submit($sql);
        $numbers && $this->dao->updateCacheDependency($tableInstance->getTableList());
        return $numbers;
    }

}