<?php
namespace App\Console\Providers;
use App\Console\Modules\Mission\Generics\Crontabs\CrontabContainer;
use App\Console\Modules\Mission\Generics\Crontabs\PackageCrontabConst;
use App\Console\Modules\Mission\Generics\Initializes\InitializeContainer;
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
        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageInitializeConst::PACKAGE, InitializeContainer::class, $condz):
            $this->madeContainer(PackageInitializeConst::PACKAGE, $this->getGenericContainerString(ClassConst::INIT_CATALOG), $condz);

        return $container;
    }

    public function getCronContainer(array $condz=[])
    {

        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageCrontabConst::PACKAGE, CrontabContainer::class, $condz):
            $this->madeContainer(PackageCrontabConst::PACKAGE, $this->getGenericContainerString(ClassConst::CRONTAB_CATALOG), $condz);

        return $container;

    }
}