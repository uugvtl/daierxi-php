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
     * @var boolean
     */
    private $generalize;

    /**
     * 泛化类基类所在的包名称
     * @var string
     */
    private $package;

    /**
     * @var Distributer
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
     * @param Distributer $distributer
     * @return $this
     */
    public function setDistributer(Distributer $distributer)
    {
        $this->distributer = $distributer;
        return $this;
    }


    /**
     * @return Distributer
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


    /**
     * 设置泛化类基类所在的包名称
     * @param string $package
     * @return $this
     */
    public function setPackage($package)
    {
        $this->package = $package;
        return $this;
    }

    /**
     * 获取泛化类基类所在的包名称
     * @return string
     */
    public function getPackage()
    {
        return $this->package;
    }

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
    public function hasGeneralize()
    {
        return $this->generalize;
    }

}