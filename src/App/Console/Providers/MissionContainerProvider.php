<?php
namespace App\Console\Providers;
use App\Console\Modules\Mission\Generics\Initializes\PackageInitializeConst;
use App\Console\Modules\Mission\Generics\Initializes\Services\InitializeServices;
use App\Globals\Finals\Responder;
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
    /**
     * 导出数据列表
     * @param array $condz
     * @return Responder
     */
    public function getInitResponder(array $condz=[])
    {
        $container = $this->createContainer(PackageInitializeConst::PACKAGE, InitializeServices::class, $condz);
        return $container->get();
    }
}