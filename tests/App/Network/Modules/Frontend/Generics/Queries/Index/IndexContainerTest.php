<?php
namespace App\Network\Modules\Frontend\Generics\Queries\Index;
use App\Globals\Finals\Distributer;
use App\Network\Providers\FrontendContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 23:27
 *
 * Class IndexContainerTest
 * @package App\Network\Modules\Frontend\Generics\Queries\Index
 */
class IndexContainerTest extends UnitTestCase
{
    public function test_get_list_for_index()
    {
        /** arrange */
            $params = [];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', 'Index');
        /** act */
            $provider = FrontendContainerProvider::getInstance();
            $provider->init($distributer);//->setGeneralize(YES);
        /** assert */
            $resultBo = $provider->getQueryResponder($params);
            $this->assertFalse($resultBo->toggle);
    }
}