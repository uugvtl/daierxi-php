<?php
namespace App\Globals\Stores;
use App\Globals\Bases\BaseStore;
use App\Globals\Bases\Sqlangs\BaseFields;
use App\Globals\Bases\Sqlangs\BaseWhere;
use App\Globals\Bases\Sqlangs\BaseTable;
use App\Globals\Finals\PageSlice;
use App\Helpers\FileHelper;
use App\Libraries\Daoes\CacheDao;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/8/17
 * Time: 03:24
 *
 * Class SelectStore
 * @package App\Globals\Stores
 */
abstract class SelectStore extends BaseStore
{
    /**
     * @var PageSlice
     */
    protected $pageSlice;

    /**
     * @var BaseFields
     */
    protected $fieldsInstance;

    /**
     * @var BaseWhere
     */
    protected $selectInstance;

    /**
     * @var BaseTable
     */
    protected $tableInstance;


    public function construct(...$args)
    {
        $this->fieldsInstance = $args[0];
        $this->tableInstance  = $args[1];
        $this->selectInstance = $args[2];
        return $this;
    }


    /**
     * 初始化分页功能
     * @param int $total
     * @return static
     */
    public function initPaging($total)
    {
        $this->pageSlice = PageSlice::getInstance();
        $this->pageSlice->setTotal($total);
        return $this;
    }


    /**
     * 返回分页对象
     * @return PageSlice
     */
    public function getPageSlice()
    {
        return $this->pageSlice;
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

        $aCacheDependency = $this->tableInstance->getCacheDependencyInstances($this->dao);

        $orderBy = $this->dao->getSortStmt();
        $orderBy = $orderBy ? $orderBy : $this->fieldsInstance->getOrderStmt();

        $groupBy = $this->fieldsInstance->getGroupStmt();

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where} {$groupBy} {$orderBy} {$pagingLimit};\n";
        return $this->dao->getCacheAll($sql, $aCacheDependency);
    }


    /**
     * 获取记录总数，分于分页使用
     * @return int
     */
    public function getCount()
    {
        $where = $this->selectInstance->get();

        $table = $this->tableInstance->initSelect($this->selectInstance)->getJoinTable();

        $aCacheDependency = $this->tableInstance->getCacheDependencyInstances($this->dao);

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
        return $this->dao->getCacheOne($sql, $aCacheDependency);
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

        $cacheDependency = $this->tableInstance->getCacheDependencyInstances($this->dao);

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where};\n";
        $rows = $this->dao->getCacheRow($sql, $cacheDependency);
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

        $cacheDependency = $this->tableInstance->getCacheDependencyInstances($this->dao);

        $sql = "SELECT
                    {$columns}
                FROM
                    {$table}
                WHERE
                    1=1 {$where};\n";
        $rows = $this->dao->getCacheOne($sql, $cacheDependency);
        return $rows;
    }


    /**
     * 获取分页SQL语句
     * @return string
     */
    protected function getPagingLimit()
    {
        $stmt = '';
        if($this->pageSlice)
            $stmt = $this->pageSlice->getPagingLimit();
        return $stmt;
    }

    /**
     * 只在生成成实例的时候运行一次
     */
    protected function afterInstance()
    {
        parent::afterInstance();

        $fileHelper = FileHelper::getInstance();

        $cacheInstance = require INJECT_PATH .'/cache.php';
        $this->dao = CacheDao::getInstance();
        $this->dao->construct($cacheInstance);
        /* 生成后台文件缓存目录--以类名作为目录名 BEGIN */
        $className      = get_called_class();
        $classNameDir   = str_replace('\\', '/', $className).'/';
        $cacheDir       = GENERAL_CACHE_DIR.$classNameDir;
        $fileHelper->createDir($cacheDir);
        $cacheInstance->setOptions(array(
            'cacheDir'  => $cacheDir
        ));
        /* 生成后台文件缓存目录--类名作为目录名 END */
    }

}