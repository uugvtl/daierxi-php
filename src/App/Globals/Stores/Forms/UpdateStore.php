<?php
namespace App\Globals\Stores\Forms;
use App\Globals\Bases\Generics\Sqlangs\BaseFields;
use App\Globals\Bases\Generics\Sqlangs\BaseWhere;
use App\Globals\Bases\Generics\Sqlangs\BaseTable;
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
     * @var BaseFields
     */
    protected $fieldsInstance;

    /**
     * @var  BaseWhere
     */
    protected $selectInstance;

    /**
     * @var BaseTable
     */
    protected $tableInstance;

    /**
     * 只在生成成实例的时候运行一次
     */
    protected function afterInstance()
    {
        parent::afterInstance();
        $this->dao = FormDao::getInstance();
    }


    public function construct(...$args)
    {
        $this->fieldsInstance = $args[0];
        $this->tableInstance  = $args[1];
        $this->selectInstance = $args[2];
        return $this;
    }

    /**
     * 带事务更新
     * @return int
     */
    public function commit()
    {
        $sqlHelper = SqlHelper::getInstance();
        $fields = $this->fieldsInstance->getFields();
        $subjoin = $this->fieldsInstance->getOriginal();
        $table = $this->tableInstance->getJoinTable();
        $where = $this->selectInstance->get();
        $sql = $sqlHelper->getUpdateString($fields, $table, $where, $subjoin);
        $numbers = $this->dao->commit($sql);
        $numbers && $this->dao->updateCacheDependency($this->tableInstance->getTableList());
        return $numbers;
    }

    /**
     * 无事务更新--需要手动开启事务
     * @return int
     */
    public function submit()
    {
        $sqlHelper = SqlHelper::getInstance();
        $fields     = $this->fieldsInstance->getFields();
        $subjoin    = $this->fieldsInstance->getOriginal();
        $table = $this->tableInstance->getJoinTable();
        $where = $this->selectInstance->get();
        $sql = $sqlHelper->getUpdateString($fields, $table, $where, $subjoin);
        $numbers = $this->dao->submit($sql);
        $numbers && $this->dao->updateCacheDependency($this->tableInstance->getTableList());
        return $numbers;
    }


    /**
     * 获取的查询数据DAO
     * @return FormDao
     */
    public function getDao()
    {
        return $this->dao;
    }


}