<?php
namespace App\Network\Modules\Manager\Generics\Exports\Warehouse;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Interfaces\Adapters\IShowAdapter;
use App\Network\Providers\ManagerContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:15
 *
 * Class PackingContainerTest
 * @package App\Network\Modules\Manager\Generics\Exports\Warehouse
 */
class PackingContainerTest extends UnitTestCase
{
    public function test_get_list_for_export()
    {
        /** arrange */
            $params = [];
            $distributer = Distributer::getInstance();
            $distributer->init('Warehouse\Packing', 'Export', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer)->setGeneralize(YES);
        /** assert */

            $responder = $provider->getExportResponder($params);
            $this->assertInstanceOf(IShowAdapter::class, $responder->adapter);
    }
}