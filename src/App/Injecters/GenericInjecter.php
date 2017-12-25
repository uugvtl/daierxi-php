<?php
namespace App\Injecters;
use App\Globals\Bases\BaseClass;
use App\Globals\Finals\Parameter;
use App\Globals\Finals\Distributer;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 00:43
 *
 * Class DistributeInjecter
 * @package App\Injecters
 */
class GenericInjecter extends BaseClass
{
    /**
     * @var \App\Globals\Finals\Distributer
     */
    private $distributer;

    /**
     * @var Parameter
     */
    private $parameter;

    public function __clone()
    {
        $this->distributer = clone $this->distributer;
        $this->parameter = clone $this->parameter;
    }

    /**
     * @param \App\Globals\Finals\Distributer $distributer
     * @return $this
     */
    public function setDistributer(Distributer $distributer)
    {
        $this->distributer = $distributer;
        return $this;
    }


    /**
     * @return \App\Globals\Finals\Distributer
     */
    public function getDistributer()
    {
        return $this->distributer;
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
     * @return Parameter
     */
    public function getParameter()
    {
        return $this->parameter;
    }
}