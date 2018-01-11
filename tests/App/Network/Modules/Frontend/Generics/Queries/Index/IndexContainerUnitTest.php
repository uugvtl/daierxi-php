<?php
namespace App\Network\Modules\Frontend\Generics\Queries\Index;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\FrontendContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 23:27
 *
 * Class IndexContainerTest
 * @package App\Network\Modules\Frontend\Generics\Queries\Index
 */
class IndexContainerUnitTest extends AppUnitTest
{
    public function test_get_list_for_index()
    {
        /** arrange */
            $params = [];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = FrontendContainerProvider::getInstance();
            $container = $provider->init($distributer)->getQueryContainer($params);//->setGeneralize(YES);
        /** assert */
            $responder = $container->get();
            $this->assertFalse($responder->toggle);
    }
}