<?php
namespace App\Factories\Generics;
use App\Globals\Bases\BaseSingle;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 13:12
 *
 * Class BaseFactory
 * @package App\Factories\Generics
 */
abstract class BaseFactory extends BaseSingle
{
    /**
     * 泛化类基类所在的包名称
     * @var string
     */
    private $package;

    /**
     * 产生泛化类的基类名称
     * @var string
     */
    private $baseClass;

    /**
     * 设置泛化类基类的名称
     * @param string $baseClass
     * @return $this
     */
    public function setBaseClass($baseClass)
    {
        $this->baseClass = $baseClass;
        return $this;
    }

    /**
     * 获取泛化类基类的名称
     * @return string
     */
    public function getBaseClass()
    {
        return $this->baseClass;
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
}