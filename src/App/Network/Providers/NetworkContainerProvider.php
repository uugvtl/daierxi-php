<?php
namespace App\Network\Providers;
use App\Globals\Generics\BaseContainer;
use App\Helpers\InstanceHelper;
use App\Injecters\GenericInjecter;
use App\Interfaces\Providers\INetContainerProvider;
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
abstract class NetworkContainerProvider extends BaseContainerProvider implements INetContainerProvider
{
    /**
     * 产生 container 容器
     * @param array $params         参数
     * @param string $package       包名称
     * @param string $classname     类名称
     * @return BaseContainer
     */
    protected function createContainer(array $params, $package, $classname)
    {

        $parameter = $this->getParameter();
        $distributer = $this->getDistributer();

        $parameter->init($params);

        $genericInjecter = GenericInjecter::getInstance();;

        $genericInjecter->setDistributer($distributer);
        $genericInjecter->setParameter($parameter);
        $genericInjecter->setPackage($package);
        $genericInjecter->setGeneralize($this->hasGeneralize());

        $instanceHelper = InstanceHelper::getInstance();
        $container = $instanceHelper->build(BaseContainer::class, $classname);
        return $container->setGenericInjecter($genericInjecter);

    }
}