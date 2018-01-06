<?php
namespace App\Globals\Bizes;
use App\Globals\Bases\BaseBiz;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 18:51
 *
 * Class CalcBaseBo
 * @package App\Globals\Bizes
 */
abstract class CalcBaseBo extends BaseBiz
{
    /**
     * 所属实例的 ID
     * @return mixed
     */
    abstract public function belongId();

    /**
     * 主键 ID
     * @return mixed
     */
    abstract public function primaryKey();

    /**
     * 对相关属性进行运算
     * @return mixed
     */
    abstract public function calc();

    /**
     * 获取运算后的结果
     * @return mixed
     */
    public function get(){return $this->getProperties();}
}