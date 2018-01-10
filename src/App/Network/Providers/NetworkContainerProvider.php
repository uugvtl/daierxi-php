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
     * @param string $containerPrefix
     * @return string
     */
    final protected function getGenericContainerString($containerPrefix=ClassConst::GENERIC_PREFIX)
    {
        $documentString = $containerPrefix.ClassConst::CONTAINER_SUFFIX;
        $containerString = PackageGenericConst::PACKAGE.BACKSLASH . $documentString;

        return $containerString;
    }
}