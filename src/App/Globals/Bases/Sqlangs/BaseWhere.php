<?php
namespace App\Globals\Bases\Sqlangs;
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
     * @return string
     */
    public function get()
    {
        $where = '';
        $where.= $this->beforeGetWhere();
        $where.= $this->getWhere();
        $where.= $this->afterGetWhere();

        return $this->getJudgeWhere($where);
    }


    /**
     * 获取最终型态的where条件的where语句
     * @param string $where         SQL语句中的where条件语句
     * @return string               可能是原语句，也可能是永远无法获取数据的where条件语句
     */
    protected function getJudgeWhere($where='')
    {
        return $where;
    }

    /**
     * 获取查询过滤条件
     * @return array                查询过滤条件数组数据
     */
    protected function getCondition()
    {
        return [];//$this->getParameter()->get();
    }


    /**
     * 获符合SQL语句使用的字符串数据值
     * @param string $value         字符串
     * @param bool  $isLike         是否用于LIKE查询
     * @return string               转义后的字符串
     */
    protected function getQuoteValue($value, $isLike=false)
    {
        $stringHelper = StringHelper::getInstance();

        $value = $stringHelper->encode($value);
        if($isLike)
            $value = "%{$value}%";

        $value = $stringHelper->quoteValue($value);

        return $value;
    }

    /**
     * getWhere的后置回调函数用
     * @return string
     */
    protected function afterGetWhere()
    {
        return '';
    }

    /**
     * getWhere的前置回调函数用
     * @return string
     */
    protected function beforeGetWhere()
    {
        return '';
    }

    abstract protected function getWhere();

}