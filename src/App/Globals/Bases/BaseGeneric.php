<?php
namespace App\Globals\Bases;
use App\Globals\Finals\Parameter;
use App\Interfaces\IGenericable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 01:56
 *
 * Class BaseGeneric
 * @package App\Globals\Bases
 */
abstract class BaseGeneric extends BaseClass implements IGenericable
{
    /**
     * @var Parameter
     */
    private $parameter;

    private $generalize;

    /**
     * 设置是否使用泛化实例
     * @param bool $boolean     使用为true,否则为false
     * @return $this
     */
    public function setGeneralize($boolean=false)
    {
        $this->generalize = $boolean;
        return $this;
    }

    /**
     * 判断是否使用泛化实例
     * @return bool
     */
    public function isGeneralize()
    {
        return $this->generalize;
    }

    /**
     * 设置参数实例
     * @param Parameter $parameter
     * @return $this
     */
    public function setParameter(Parameter $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }

    /**
     * 克隆参数实例
     * @param Parameter $parameter
     * @return $this
     */
    public function cloneParameter(Parameter $parameter)
    {
        $this->parameter = clone $parameter;
        return $this;
    }

    /**
     * @return Parameter
     */
    public function getParameter()
    {
        return $this->parameter;
    }

}