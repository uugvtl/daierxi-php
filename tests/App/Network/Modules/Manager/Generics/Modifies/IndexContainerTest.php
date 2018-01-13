<?php
namespace App\Network\Modules\Manager\Generics\Modifies;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 13:45
 *
 * Class IndexContainerTest
 * @package App\Network\Modules\Manager\Generics\Modifies
 */
class IndexContainerTest extends AppUnitTest
{
    public function test_modify_for_index()
    {
        /** arrange */
            $params = [
                'account'   =>'admin',
                'password'  =>'123456'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}