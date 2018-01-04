<?php
namespace App\Network\Modules\Manager\Generics\Queries\Index;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 22:46
 *
 * Class IndexContainerTest
 * @package App\Network\Modules\Manager\Generics\Queries\Index
 */
class IndexContainerTest extends UnitTestCase
{
    public function test_get_list_for_default()
    {
        /** arrange */
            $params = [
                'account'   =>'d',
                'password'  =>'1'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer)->setGeneralize(YES);
        /** assert */
            $responder = $provider->getQueryResponder($params);
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_get_list_for_cookie()
    {
        /** arrange */
            $params = [
                'manager_id'=>1
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer)->setGeneralize(YES)->setPrefixString('Cookie');
        /** assert */
            $responder = $provider->getQueryResponder($params);
            $this->assertTrue($responder->toggle);
    }
}