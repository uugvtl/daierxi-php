<?php
namespace App\Network\Generics\Queries;
use App\Globals\Bases\BaseGeneric;
use App\Globals\Bases\BaseStore;
use App\Globals\Finals\PageSlice;
use App\Globals\Sqlangs\BaseFields;
use App\Globals\Sqlangs\BaseTable;
use App\Globals\Sqlangs\BaseWhere;
use App\Globals\Stores\Selects\CacheStore;
use App\Helpers\InstanceHelper;
use App\Injecters\GenericInjecter;
use App\Injecters\SqlangInjecter;
use const BACKSLASH;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/12/17
 * Time: 15:23
 *
 * Class GenericSqlang
 * @package App\Network\Generics\Queries
 */
abstract class GenericSqlang extends BaseGeneric
{
    /**
     * @var string
     */
    private $catalog;


    /**
     * @param $catalog
     * @return $this
     */
    final public function setCatalog($catalog)
    {
        $this->catalog = $catalog;
        return $this;
    }


    /**
     * @return BaseStore
     */
    final public function createStoreInstance()
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

        $cacheStore = CacheStore::getInstance();
        $cacheStore->setSqlangInjecter($injecter);

        return $cacheStore;
    }

    protected function afterInstance()
    {
        $this->catalog = 'Queries';
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
        return $package.BACKSLASH.'Sqlangs'.BACKSLASH.$this->getCatalog().BACKSLASH.$path;
    }

    /**
     * @return string
     */
    final protected function getCatalog()
    {
        return $this->catalog;
    }
}