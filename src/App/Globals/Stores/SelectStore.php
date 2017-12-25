<?php
namespace App\Globals\Stores;
use App\Globals\Bases\BaseStore;
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
     * 操作数据的封状工具类
     * @var CacheDao
     */
    private $dao;

    public function init(...$args)
    {
        $total = (int)$args[0];
        $this->getStoreInjecter()->getPageInstance()->setTotal($total);
        return $this;
    }

    /**
     * 获取一组列表数据
     * @return mixed
     */
    public function getList()
    {
        $pagingLimit= $this->getPagingLimit();

        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $columns= $fieldsInstance->getColumns();
        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $aCacheDependency = $tableInstance->getCacheDependencyInstances($this->dao);

        $orderBy = $this->dao->getSortStmt();
        $orderBy = $orderBy ? $orderBy : $fieldsInstance->getOrderStmt();

        $groupBy = $fieldsInstance->getGroupStmt();

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
        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $aCacheDependency = $tableInstance->getCacheDependencyInstances($this->dao);

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
        return $this->dao->getCacheOne($sql, $aCacheDependency);
    }

    /**
     * 获取一条记录数据信息
     * @return mixed
     */
    public function getRow()
    {
        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $columns= $fieldsInstance->getColumns();
        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $cacheDependency = $tableInstance->getCacheDependencyInstances($this->dao);

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
        $fieldsInstance = $this->getStoreInjecter()->getFieldsInstance();
        $tableInstance  = $this->getStoreInjecter()->getTableInstance();
        $whereInstance  = $this->getStoreInjecter()->getWhereInstance();

        $columns= $fieldsInstance->getColumns();
        $table  = $tableInstance->getJoinTable();
        $where  = $whereInstance->get();

        $cacheDependency = $tableInstance->getCacheDependencyInstances($this->dao);

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
        $pageSlice = $this->getStoreInjecter()->getPageInstance();

        $stmt = '';
        if($pageSlice)
            $stmt = $pageSlice->getPagingLimit();
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
        $this->dao->init($cacheInstance);
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