<?php
namespace App\Globals\Sqlangs;
use App\Globals\Bases\BaseClass;
use App\Helpers\StringHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/23
 * Time: 16:55
 *
 * Class BaseWhere
 * @package App\Globals\Sqlangs\Selects
 */
abstract class BaseWhere extends BaseClass
{
    /**
     * @var bool
     */
    private $nothing;

    /**
     * @var array
     */
    private $condition;

    public function init(...$args)
    {
        $this->condition = $args[0];
        return $this;
    }

    /**
     * @return string
     */
    final public function get()
    {
        $where = '';
        $where.= $this->beforeGetStmt();
        $where.= $this->getStmt();
        $where.= $this->afterGetStmt();

        return $this->getJudgeWhere($where);
    }

    /**
     * 条件不存的时候，是否返还为空       返回空条件为true,否则为false
     * @param bool $nothing
     * @return $this
     */
    protected function setNothing($nothing=false)
    {
        $this->nothing = (bool)$nothing;
        return $this;
    }

    /**
     * 获取查询过滤条件
     * @return array                查询过滤条件数组数据
     */
    protected function getCondition()
    {
        return $this->condition;
    }


    /**
     * 获符合SQL语句使用的字符串数据值
     * @param string $value         字符串
     * @param bool  $likeStmt         是否用于LIKE查询
     * @return string               转义后的字符串
     */
    protected function getQuoteValue($value, $likeStmt=false)
    {
        $stringHelper = StringHelper::getInstance();

        $value = $stringHelper->encode($value);
        if($likeStmt)
            $value = "%{$value}%";

        $value = $stringHelper->quoteValue($value);

        return $value;
    }

    /**
     * getWhere的后置回调函数用
     * @return string
     */
    protected function afterGetStmt()
    {
        return '';
    }

    /**
     * getWhere的前置回调函数用
     * @return string
     */
    protected function beforeGetStmt()
    {
        return '';
    }

    /**
     * 获取Where 条件语句
     * @return string
     */
    protected function getStmt()
    {
        return '';
    }

    /**
     * 获取最终型态的where条件的where语句
     * @param string $where         SQL语句中的where条件语句
     * @return string               可能是原语句，也可能是永远无法获取数据的where条件语句
     */
    private function getJudgeWhere($where='')
    {
        if($this->nothing)
            empty($where) && $where = " AND FALSE";
        return $where;
    }

}