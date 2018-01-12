<?php
namespace App\Network\Providers;
use App\Datasets\Consts\ClassConst;
use App\Datasets\Consts\ClassPrefix;
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
     * @var string
     */
    private $containerPrefix;

    /**
     * 设置 要使用的 Container类前辍名称
     * @param string $containerPrefix
     * @return $this
     */
    final public function setGenericContainerPrefix($containerPrefix=ClassPrefix::GENERIC)
    {
        $this->containerPrefix = $containerPrefix;
        return $this;
    }

    /**
     * 获取 GenericContainer 类名的字符串
     * @return string
     */
    final protected function getGenericContainerString()
    {
        $this->containerPrefix || $this->setGenericContainerPrefix();
        $documentString = $this->containerPrefix.ClassConst::CONTAINER_SUFFIX;
        $containerString = PackageGenericConst::PACKAGE.BACKSLASH . $documentString;

        return $containerString;
    }
}