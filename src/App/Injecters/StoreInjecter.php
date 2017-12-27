<?php
namespace App\Injecters;
use App\Globals\Bases\BaseClass;
use App\Globals\Bases\Sqlangs\BaseFields;
use App\Globals\Bases\Sqlangs\BaseTable;
use App\Globals\Bases\Sqlangs\BaseWhere;
use App\Globals\Finals\PageSlice;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 21:05
 *
 * Class StoreInjecter
 * @package App\Injecters
 */
class StoreInjecter extends BaseClass
{
    /**
     * @var BaseFields
     */
    private $fieldsInstance;

    /**
     * @var BaseTable
     */
    private $tableInstance;

    /**
     * @var BaseWhere
     */
    private $whereInstance;

    /**
     * @var PageSlice
     */
    private $pageInstance;

    /**
     * @param BaseFields $fieldsInstance
     * @return StoreInjecter
     */
    public function setFieldsInstance(BaseFields $fieldsInstance)
    {
        $this->fieldsInstance = $fieldsInstance;
        return $this;
    }

    /**
     * @param BaseTable $tableInstance
     * @return StoreInjecter
     */
    public function setTableInstance(BaseTable $tableInstance)
    {
        $this->tableInstance = $tableInstance;
        return $this;
    }

    /**
     * @param BaseWhere $whereInstance
     * @return StoreInjecter
     */
    public function setWhereInstance(BaseWhere $whereInstance)
    {
        $this->whereInstance = $whereInstance;
        return $this;
    }

    /**
     * @param PageSlice $pageInstance
     * @return StoreInjecter
     */
    public function setPageInstance(PageSlice $pageInstance)
    {
        $this->pageInstance = $pageInstance;
        return $this;
    }

    /**
     * 获取 Store 用到的fields 实例
     * @return BaseFields
     */
    public function getFieldsInstance()
    {
        return $this->fieldsInstance;
    }

    /**
     * 获取 Store 用到的table 实例
     * @return BaseTable
     */
    public function getTableInstance()
    {
        return $this->tableInstance;
    }

    /**
     * 获取 Store 用到的where 实例
     * @return BaseWhere
     */
    public function getWhereInstance()
    {
        return $this->whereInstance;
    }

    /**
     * 获取 Store 用到的page 实例
     * @return PageSlice
     */
    public function getPageInstance()
    {
        return $this->pageInstance;
    }
}