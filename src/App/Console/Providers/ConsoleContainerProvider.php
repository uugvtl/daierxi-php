<?php
namespace App\Console\Providers;
use App\Console\Generics\PackageGenericConst;
use App\Datasets\Consts\ClassConst;
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
     * @var string
     */
    private $containerPrefix;

    /**
     * 设置 要使用的 Container类前辍名称
     * @param string $containerPrefix
     * @return $this
     */
    final public function setGenericContainerPrefix($containerPrefix=ClassConst::GENERIC_PREFIX)
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