<?php
namespace App\Console\Providers;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;
use App\Interfaces\Providers\IConsoleContainerProvider;
use App\Providers\BaseContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 21:09
 *
 * Class CliContainerProvider
 * @package App\Console\Providers
 */
abstract class ConsoleContainerProvider extends BaseContainerProvider implements IConsoleContainerProvider
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