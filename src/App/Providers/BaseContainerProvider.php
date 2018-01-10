<?php
namespace App\Providers;
use App\Frames\Generics\FrameContainer;
use App\Globals\Bases\BaseClass;
use App\Globals\Finals\Distributer;
use App\Globals\Finals\Parameter;
use App\Helpers\ErrorsHelper;
use App\Helpers\InstanceHelper;
use App\Injecters\GenericInjecter;
use App\Interfaces\Providers\IMockContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:11
 *
 * Class MockContainerProvider
 * @package App\Network\Providers
 */
abstract class BaseContainerProvider extends BaseClass implements IMockContainerProvider
{
    /**
     * @var GenericInjecter
     */
    private $genericInjecter;


    final public function init(...$args)
    {
        $distributer = $args[0];

        if(!$distributer instanceof Distributer)
        {
            $errorsHelper = ErrorsHelper::getInstance();
            $errorsHelper->triggerError('init method only accepts Class Distributer. Input was: '.$distributer);
        }

        $parameter = Parameter::getInstance();
        $this->genericInjecter = GenericInjecter::getInstance();

        $this->genericInjecter->setDistributer($distributer);
        $this->genericInjecter->setParameter($parameter);

        return $this;
    }


    /**
     * 产生 container 容器
     * @param string $package 包名称
     * @param string $classname 类名称
     * @param array $params 参数
     * @return FrameContainer
     */
    final protected function madeContainer($package, $classname, array $params)
    {
        $genericInjecter = $this->genericInjecter;

        $genericInjecter->getParameter()->init($params);
        $genericInjecter->setPackage($package);

        $instanceHelper = InstanceHelper::getInstance();
        $container = $instanceHelper->build(FrameContainer::class, $classname);
        $container->setGenericInjecter($genericInjecter->init($container));

        return $container;

    }

}