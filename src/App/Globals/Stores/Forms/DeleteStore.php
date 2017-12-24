<?php
namespace App\Globals\Stores\Forms;
use App\Globals\Bases\Sqlangs\BaseSelect;
use App\Globals\Bases\Sqlangs\BaseTable;
use App\Globals\Stores\FormStore;
use App\Helpers\CSqlHelper;
use App\Libraries\Cases\Daoes\FormDao;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/8/17
 * Time: 16:18
 *
 * Class DeleteStore
 * @package App\Globals\Stores
 */
class DeleteStore extends FormStore
{
    /**
     * 操作数据的封状工具类
     * @var FormDao
     */
    protected $dao;

    /**
     * @var  BaseSelect
     */
    protected $selectInstance;

    /**
     * @var BaseTable
     */
    protected $tableInstance;

    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct()
    {
        parent::onceConstruct();
        $this->dao = FormDao::getInstance();
    }


    public function construct(...$args)
    {
        $this->selectInstance = $args[0];
        $this->tableInstance = $args[1];
        return $this;
    }

    /**
     * 带事务删除
     * @return int
     */
    public function commit()
    {
        $sqlHelper = CSqlHelper::getInstance();
        $table = $this->tableInstance->initSelect($this->selectInstance)->getJoinTable();
        $where = $this->selectInstance->get();
        $alias = $this->tableInstance->getAliasTable();
        $sql = $sqlHelper->getDeleteString($table, $where, $alias);
        $numbers = $this->dao->commit($sql);
        $numbers && $this->dao->updateCacheDependency($this->tableInstance->getTableList());
        return $numbers;
    }

    /**
     * 无事务删除--需要手动开启事务
     * @return int
     */
    public function submit()
    {
        $sqlHelper = CSqlHelper::getInstance();

        $table = $this->tableInstance->initSelect($this->selectInstance)->getJoinTable();
        $where = $this->selectInstance->get();
        $alias = $this->tableInstance->getAliasTable();
        $sql = $sqlHelper->getDeleteString($table, $where, $alias);
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