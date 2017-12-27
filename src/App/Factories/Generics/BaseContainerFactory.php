<?php
namespace App\Factories\Generics;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 10:57
 *
 * Class ContainerFactory
 * @package App\Factories\Generics
 */
abstract class BaseContainerFactory extends BaseFactory
{
//    /**
//     * 单例方法,用于访问实例的公共的静态方法
//     * 返回此类的子类实例
//     * @param GenericInjecter $injecter
//     * @return mixed
//     */
//    public function createInstance(GenericInjecter $injecter)
//    {
////        $className = $this->package . BACKSLASH . $this->baseClass;
////        $container = call_user_func(array($className, 'loadInstance'), $distributer); /* @var $container IContainerable */
////        $container->setSpread($this->getSpread());
////        return $container;
//    }
}