<?php
namespace App\Globals\Stores\Selects;
use App\Globals\Stores\SelectStore;
use App\Libraries\Daoes\CacheDao;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/20
 * Time: 11:41
 *
 * Class GlobalConsoleStore
 * @package App\Globals\Stores
 */
class SearchStore extends SelectStore
{
    /**
     * 只在生成成实例的时候运行一次
     */
    protected function afterInstance()
    {
        parent::afterInstance();

        $cacheInstance = require INJECT_PATH .'/cache.php';
        $this->dao = CacheDao::getInstance();
        $this->dao->construct($cacheInstance);
    }


    /**
     * 获取一组列表数据
     * @return mixed
     */
    public function getList()
    {
        $pagingLimit= $this->getPagingLimit();

        $columns    = $this->fieldsInstance->getColumns();
        $where      = $this->selectInstance->get();

        $table = $this->tableInstance->initSelect($this->selectInstance)->getJoinTable();

        $orderBy = $this->dao->getSortStmt();
        $orderBy = $orderBy ? $orderBy : $this->fieldsInstance->getOrderStmt();

        $groupBy = $this->fieldsInstance->getGroupStmt();

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where} {$groupBy} {$orderBy} {$pagingLimit};\n";
        return $this->dao->fetchAll($sql);
    }


    /**
     * 获取记录总数，分于分页使用
     * @return int
     */
    public function getCount()
    {
        $where = $this->selectInstance->get();

        $table = $this->tableInstance->initSelect($this->selectInstance)->getJoinTable();

        $groupBy = $this->fieldsInstance->getGroupStmt();

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
        return $this->dao->fetchOne($sql);
    }

    /**
     * 获取一条记录数据信息
     * @return mixed
     */
    public function getRow()
    {
        $columns = $this->fieldsInstance->getColumns();

        $table  = $this->tableInstance->getJoinTable();

        $where = $this->selectInstance->get();

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where};\n";
        $rows = $this->dao->fetchRow($sql);
        return $rows;
    }

    /**
     * 获取一条记录数据信息
     * @return mixed
     */
    public function getOne()
    {
        $columns = $this->fieldsInstance->getColumns();

        $table  = $this->tableInstance->getJoinTable();

        $where = $this->selectInstance->get();

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where};\n";
        $rows = $this->dao->fetchOne($sql);
        return $rows;
    }
}