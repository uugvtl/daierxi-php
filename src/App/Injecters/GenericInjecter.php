<?php
namespace App\Injecters;
use App\Globals\Bases\BaseClass;
use App\Globals\Finals\Parameter;
use App\Globals\Finals\Distributer;
use App\Interfaces\Generics\IPreservable;
use App\Interfaces\Generics\IRespondable;

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
     * 泛化类的基类名称
     * @var string
     */
    private $baseClassString;
    
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

    /**
     * @var IRespondable|IPreservable
     */
    private $owner;



    final public function init(...$args)
    {
        $owner = $args[0];
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return IPreservable|IRespondable
     */
    final public function owner()
    {
        return $this->owner;
    }

    /**
     * @param Distributer $distributer
     * @return $this
     */
    final public function setDistributer(Distributer $distributer)
    {
        $this->distributer = $distributer;
        return $this;
    }


    /**
     * @return Distributer
     */
    final public function getDistributer()
    {
        return $this->distributer;
    }

    /**
     * 设置参数实例
     * @param Parameter $parameter
     * @return $this
     */
    final public function setParameter(Parameter $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }


    /**
     * @return Parameter
     */
    final public function getParameter()
    {
        return $this->parameter;
    }


    /**
     * 设置泛化类基类所在的包名称
     * @param string $package
     * @return $this
     */
    final public function setPackage($package)
    {
        $this->package = $package;
        return $this;
    }

    /**
     * 获取泛化类基类所在的包名称
     * @return string
     */
    final public function getPackage()
    {
        return $this->package;
    }

    /**
     * 设置是否使用泛化实例
     * @param bool $boolean     使用为true,否则为false
     * @return $this
     */
    final public function setGeneralize($boolean=false)
    {
        $this->generalize = $boolean;
        return $this;
    }

    /**
     * 判断是否使用泛化实例
     * @return bool
     */
    final public function hasGeneralize()
    {
        return $this->generalize;
    }

    /**
     * 获取泛化类的基类名称
     * @return string
     */
    final public function getBaseClassString()
    {
        return $this->baseClassString;
    }

    /**
     * 设置泛化类的基类名称
     * @param string $baseClassString
     * @return $this
     */
    final public function setBaseClassString($baseClassString)
    {
        $this->baseClassString = $baseClassString;
        return $this;
    }

    final public function __clone()
    {
        $this->distributer = clone $this->distributer;
        $this->parameter = clone $this->parameter;
    }
}