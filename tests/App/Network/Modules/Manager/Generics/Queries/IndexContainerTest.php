<?php
namespace App\Network\Modules\Manager\Generics\Queries;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 22:46
 *
 * Class IndexContainerTest
 * @package App\Network\Modules\Manager\Generics\Queries
 */
class IndexContainerTest extends AppUnitTest
{
    public function test_get_list_for_default()
    {
        /** arrange */
            $params = [
                'manager_id'=>1
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getQueryContainer($params);
        /** assert */
            $container->getGenericInjecter()->useGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

}