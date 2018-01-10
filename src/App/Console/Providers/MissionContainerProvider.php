<?php
namespace App\Console\Providers;
use App\Console\Modules\Mission\Generics\Crontabs\PackageCrontabConst;
use App\Console\Modules\Mission\Generics\Initializes\PackageInitializeConst;
use App\Datasets\Consts\ClassConst;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:42
 *
 * Class MissionContainerProvider
 * @package App\Console\Providers
 */
class MissionContainerProvider extends ConsoleContainerProvider
{
    public function getInitContainer(array $condz=[])
    {
        $containerString = $this->getGenericContainerString(ClassConst::GENERIC_PREFIX);
        return $this->madeContainer(PackageInitializeConst::PACKAGE, $containerString, $condz);
    }

    public function getCronContainer(array $condz=[])
    {
        $containerString = $this->getGenericContainerString(ClassConst::GENERIC_PREFIX);
        return $this->madeContainer(PackageCrontabConst::PACKAGE, $containerString, $condz);
    }
}