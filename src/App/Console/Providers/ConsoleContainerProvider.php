<?php
namespace App\Console\Providers;
use App\Datasets\Consts\ClassConst;
use App\Interfaces\Providers\IConsoleContainerProvider;
use App\Network\Generics\PackageGenericConst;
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