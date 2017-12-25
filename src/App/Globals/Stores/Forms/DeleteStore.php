<?php
namespace App\Globals\Stores\Forms;
use App\Globals\Stores\FormStore;
use App\Helpers\SqlHelper;
use App\Libraries\Daoes\FormDao;
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
     * 只在生成成实例的时候运行一次
     */
    protected function afterInstance()
    {
        parent::afterInstance();
        $this->dao = FormDao::getInstance();
    }


    /**
     * 带事务删除
     * @return int
     */
    public function commit()
    {
        $sqlHelper = SqlHelper::getInstance();

        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $table = $tableInstance->getJoinTable();
        $alias = $tableInstance->getAliasTable();
        $where = $whereInstance->get();


        $sql = $sqlHelper->getDeleteString($table, $where, $alias);
        $numbers = $this->dao->commit($sql);
        $numbers && $this->dao->updateCacheDependency($tableInstance->getTableList());
        return $numbers;
    }

    /**
     * 无事务删除--需要手动开启事务
     * @return int
     */
    public function submit()
    {
        $sqlHelper = SqlHelper::getInstance();

        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $table = $tableInstance->getJoinTable();
        $alias = $tableInstance->getAliasTable();
        $where = $whereInstance->get();

        $sql = $sqlHelper->getDeleteString($table, $where, $alias);
        $numbers = $this->dao->submit($sql);
        $numbers && $this->dao->updateCacheDependency($tableInstance->getTableList());
        return $numbers;
    }

}