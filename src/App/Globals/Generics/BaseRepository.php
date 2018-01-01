<?php
namespace App\Globals\Generics;
use App\Globals\Bases\BaseGeneric;
use App\Globals\Bases\BaseStore;
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
abstract class BaseRepository extends BaseGeneric implements IPreservable
{
    /**
     * @var string
     */
    private $sqlangCatalog;

    /**
     * @param $sqlangCatalog
     * @return $this
     */
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

    /**
     * @return SqlangInjecter
     */
    protected function createSqlangInjecter()
    {
        $injecter = SqlangInjecter::getInstance();

        $fieldsInstance = $this->createFieldsInstance();
        $tableInstance  = $this->createTableInstance();
        $whereInstance  = $this->createWhereInstance();

        $pageInstance = PageSlice::getInstance();

        $injecter->setFieldsInstance($fieldsInstance);
        $injecter->setTableInstance($tableInstance);
        $injecter->setWhereInstance($whereInstance);
        $injecter->setPageInstance($pageInstance);

        return $injecter;
    }

    protected function afterInstance()
    {
        $this->sqlangCatalog = 'Queries';
    }


    protected function createFieldsInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter();
        $classname = $this->getClassPath($genericInjecter).'Fields';

        $fieldsInstance = $instanceHelper->build(BaseFields::class, $classname);

        return $fieldsInstance;

    }

    protected function createTableInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter();
        $classname = $this->getClassPath($genericInjecter).'Table';

        $fieldsInstance = $instanceHelper->build(BaseTable::class, $classname);

        return $fieldsInstance;
    }

    protected function createWhereInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter();
        $classname = $this->getClassPath($genericInjecter).'Where';

        $fieldsInstance = $instanceHelper->build(BaseWhere::class, $classname);

        return $fieldsInstance->init($genericInjecter->getParameter()->get());
    }

    /**
     * 获取 Sqlang 相关实例的所在命名空间
     * @param GenericInjecter $genericInjecter
     * @return string
     */
    private function getClassPath(GenericInjecter $genericInjecter)
    {
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getPath();
        return $package.BACKSLASH.'Sqlangs'.BACKSLASH.$this->getSqlangCatalog().BACKSLASH.$path;
    }


    /**
     * @return BaseStore
     */
    abstract protected function createStoreInstance();

    /**
     * @return BaseStore
     */
    abstract public function run();
}