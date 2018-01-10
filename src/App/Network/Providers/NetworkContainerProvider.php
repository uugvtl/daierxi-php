<?php
namespace App\Network\Providers;
use App\Datasets\Consts\ClassConst;
use App\Interfaces\Providers\INetworkContainerProvider;
use App\Network\Generics\PackageGenericConst;
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
     * 获取 GenericContainer 类名的字符串
     * @param string $catalog
     * @return string
     */
    final protected function getGenericContainerString($catalog)
    {
        $containerString = PackageGenericConst::PACKAGE.BACKSLASH.
        $catalog.BACKSLASH.
        ClassConst::GENERIC_PREFIX.ClassConst::CONTAINER_SUFFIX;

        return $containerString;
    }
}