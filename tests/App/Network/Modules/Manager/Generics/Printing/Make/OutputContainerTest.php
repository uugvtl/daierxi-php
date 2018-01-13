<?php
namespace App\Network\Modules\Manager\Generics\Printing\Make;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Interfaces\Adapters\IShowAdapter;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 17:47
 *
 * Class OutputContainerTest
 * @package App\Network\Modules\Manager\Generics\Printing\Make
 */
class OutputContainerTest extends AppUnitTest
{
    public function setUp()
    {
        parent::setUp();

        $di = $this->getDI();

        /* Setting up the view component BEGIN  */
        $di->set('view', function (){
            return require INJECT_PATH.'/network/manager/view.php';
        }, true);
        /* Setting up the view component END  */

        $this->setDI($di);
    }

    public function test_print_output()
    {
        /** arrange */
        $params = [
            'sdetail_id'=>'1',
            'account_name'=>'leon'
        ];
            $distributer = Distributer::getInstance();
            $distributer->init('Make\Output', 'Poutput', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getPrintContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
            if($responder->toggle)
                $this->assertInstanceOf(IShowAdapter::class, $responder->adapter);
    }
}