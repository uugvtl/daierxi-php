<?php
namespace App\Network\Modules\Manager\Generics\Queries;
use App\Datasets\Consts\ClassConst;
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
class IndexContainerUnitTest extends AppUnitTest
{
    public function test_get_list_for_default()
    {
        /** arrange */
            $params = [
                'account'   =>'admin',
                'password'  =>'123456'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer);
        /** assert */
            $container = $provider->getQueryContainer($params);
            $container->getGenericInjecter()->useGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_get_list_for_cookie()
    {
        /** arrange */
            $params = [
                'manager_id'=>1
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer);
        /** assert */
            $container = $provider->getQueryContainer($params);
            $container->getGenericInjecter()->useGeneralize(YES)->getDistributer()->setPrefixString('Cookie');
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}