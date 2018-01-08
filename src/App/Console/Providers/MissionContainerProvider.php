<?php
namespace App\Console\Providers;
use App\Console\Modules\Mission\Generics\Crontabs\PackageCrontabConst;
use App\Console\Modules\Mission\Generics\Crontabs\Services\CrontabService;
use App\Console\Modules\Mission\Generics\Initializes\PackageInitializeConst;
use App\Console\Modules\Mission\Generics\Initializes\Services\InitializeServices;
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
        return $this->madeContainer(PackageInitializeConst::PACKAGE, InitializeServices::class, $condz);
    }

    public function getCronContainer(array $condz=[])
    {
        return $this->madeContainer(PackageCrontabConst::PACKAGE, CrontabService::class, $condz);
    }
}