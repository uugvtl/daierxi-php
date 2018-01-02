<?php
namespace App\Globals\Sqlangs;
use App\Globals\Bases\BaseClass;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/27
 * Time: 22:09
 *
 * Class BaseFields
 * @package App\Globals\Sqlangs\Fields
 */
abstract class BaseFields extends BaseClass
{
    /**
     * @var string[]
     */
    protected $fields;

    /**
     * @var string[]
     */
    protected $original;

    /**
     * @var string
     */
    protected $orderstmt;

    /**
     * @var string
     */
    protected $groupstmt;


    /**
     * 返回要获取SQL字段列表
     * @return string[]
     */
    final public function getFields()
    {
        return $this->fields?$this->fields:[];
    }

    /**
     * 返回要获取SQL字段附加列表--一些不需要进行转义的字段
     * @return string[]
     */
    final public function getOriginal()
    {
        return $this->original?$this->original:[];
    }

    /**
     * 获取SQL的查询字段列表
     * @return string
     */
    final public function getColumns()
    {
        return implode(',', $this->fields);
    }

    /**
     * 获取 Order By 语句
     * @return string
     */
    final public function getOrderStmt()
    {
        return $this->orderstmt;
    }

    /**
     * 获取 Group By 语句
     * @return string
     */
    final public function getGroupStmt()
    {
        return $this->groupstmt;
    }
}