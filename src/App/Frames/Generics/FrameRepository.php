<?php
namespace App\Frames\Generics;
use App\Datasets\Consts\DataConst;
use App\Frames\FrameGeneric;
use App\Globals\Finals\PageSlice;
use App\Globals\Sqlangs\BaseFields;
use App\Globals\Sqlangs\BaseTable;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\InstanceHelper;
use App\Injecters\GenericInjecter;
use App\Injecters\SqlangInjecter;
use App\Interfaces\Generics\IPreservable;
/**
 * 用来生成 Sqlang 和 Store 相关类的工厂类
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 11:00
 *
 * Class BaseRepositpry
 * @package App\Globals\Generics
 */
abstract class FrameRepository extends FrameGeneric implements IPreservable
{
    /**
     * @var string
     */
    private $sqlangCatalog;

    final public function get()
    {
        return $this->madeSqlangInjecter();
    }

    final public function setSqlangCatalog($sqlangCatalog)
    {
        $this->sqlangCatalog = $sqlangCatalog;
        return $this;
    }

    /**
     * @return string
     */
    final protected function getSqlangCatalog()
    {
        return $this->sqlangCatalog;
    }


    protected function afterInstance()
    {
        $this->sqlangCatalog = DataConst::QUERY_CATALOG;
    }


    protected function madeFieldsInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter();
        $classname = $this->getClassPath($genericInjecter).'Fields';

        $fieldsInstance = $instanceHelper->build(BaseFields::class, $classname);

        return $fieldsInstance;

    }

    protected function madeTableInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter();
        $classname = $this->getClassPath($genericInjecter).'Table';

        $tableInstance = $instanceHelper->build(BaseTable::class, $classname);

        return $tableInstance;
    }

    protected function madeWhereInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter();
        $classname = $this->getClassPath($genericInjecter).'Where';

        $whereInstance = $instanceHelper->build(BaseWhere::class, $classname);

        return $whereInstance->init($genericInjecter->getParameter()->get());
    }

    /**
     * @return SqlangInjecter
     */
    private function madeSqlangInjecter()
    {
        $injecter = SqlangInjecter::getInstance();

        $fieldsInstance = $this->madeFieldsInstance();
        $tableInstance  = $this->madeTableInstance();
        $whereInstance  = $this->madeWhereInstance();

        $pageInstance = PageSlice::getInstance();

        $injecter->setFieldsInstance($fieldsInstance);
        $injecter->setTableInstance($tableInstance);
        $injecter->setWhereInstance($whereInstance);
        $injecter->setPageInstance($pageInstance);

        return $injecter;
    }

    /**
     * 获取 Sqlang 相关实例的类全名称，不带后辍
     * @param GenericInjecter $genericInjecter
     * @return string
     */
    private function getClassPath(GenericInjecter $genericInjecter)
    {
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActFilePath();
        return $package.BACKSLASH.'Sqlangs'.BACKSLASH.$this->getSqlangCatalog().BACKSLASH.$path;
    }

}