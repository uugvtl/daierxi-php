<?php
namespace App\Console\Providers;
use App\Console\Modules\Mission\Generics\Crontabs\PackageCrontabConst;
use App\Console\Modules\Mission\Generics\Crontabs\Services\CrontabService;
use App\Console\Modules\Mission\Generics\Initializes\PackageInitializeConst;
use App\Console\Modules\Mission\Generics\Initializes\Services\InitializeServices;
use App\Datasets\Consts\ClassConst;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;

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
        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::INIT_CATALOG));
            $container->init($condz);
        }
        else
        {
            $container = $this->madeContainer(PackageInitializeConst::PACKAGE, InitializeServices::class, $condz);
        }

        return $container;
    }

    public function getCronContainer(array $condz=[])
    {
        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::CRONTAB_CATALOG));
            $container->init($condz);
        }
        else
        {
            $container = $this->madeContainer(PackageCrontabConst::PACKAGE, CrontabService::class, $condz);
        }

        return $container;

    }
}