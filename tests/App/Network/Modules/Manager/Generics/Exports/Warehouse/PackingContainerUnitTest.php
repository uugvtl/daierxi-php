<?php
namespace App\Network\Modules\Manager\Generics\Exports\Warehouse;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Interfaces\Adapters\IShowAdapter;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:15
 *
 * Class PackingContainerTest
 * @package App\Network\Modules\Manager\Generics\Exports\Warehouse
 */
class PackingContainerUnitTest extends AppUnitTest
{
    public function test_get_list_for_export()
    {
        /** arrange */
            $params = [];
            $distributer = Distributer::getInstance();
            $distributer->init('Warehouse\Packing', 'Export', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getExportContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
            if($responder->toggle)
                $this->assertInstanceOf(IShowAdapter::class, $responder->adapter);
    }
}