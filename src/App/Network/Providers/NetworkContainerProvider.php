<?php
namespace App\Network\Providers;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;
use App\Interfaces\Providers\INetworkContainerProvider;
use App\Providers\BaseContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 11:55
 *
 * Class ContainerProvider
 * @package App\Network\Providers
 */
abstract class NetworkContainerProvider extends BaseContainerProvider implements INetworkContainerProvider
{
    /**
     * 产生 container 容器
     * @param string $package 包名称
     * @param string $classname 类名称
     * @param array $params 参数
     * @return \App\Frames\Generics\FrameContainer
     */
    protected function createContainer($package, $classname, array $params)
    {
        $genericInjecter = $this->getGenericInjecter();

        $genericInjecter->getParameter()->init($params);
        $genericInjecter->setPackage($package);

        $instanceHelper = InstanceHelper::getInstance();
        $container = $instanceHelper->build(FrameContainer::class, $classname);
        $container->setGenericInjecter($genericInjecter);

        return $container;

    }
}