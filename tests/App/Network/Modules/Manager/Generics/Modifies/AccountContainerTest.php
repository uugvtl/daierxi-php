<?php
namespace App\Network\Modules\Manager\Generics\Modifies;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 19:38
 *
 * Class AccountContainerTest
 * @package App\Network\Modules\Manager\Generics\Modifies
 */
class AccountContainerTest extends AppTestCase
{
    public function test_save_for_toggle()
    {
        /** arrange */
            $params = [
                'enabled'=>1,
                'items'=>'2,5,6'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Account', 'Toggle', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->setBaseServicePrefix(ClassConst::ENABLED_PREFIX)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_save_for_group()
    {
        /** arrange */
            $params = [
                'group_id'=>25,
                'grant'=>'2,5,6'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Account', 'Group', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);

    }
}