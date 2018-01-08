<?php
namespace App\Network\Modules\Manager\Generics\Modifies;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 19:38
 *
 * Class AccountContainerTest
 * @package App\Network\Modules\Manager\Generics\Modifies
 */
class AccountContainerTest extends UnitTestCase
{
    public function test_save_for_toggle()
    {
        /** arrange */
            $params = [
                'enabled'=>1,
                'items'=>'2,5,6'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Account', 'Toggle', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer)->setGeneralize(YES);
        /** assert */
            $responder = $provider->getCommitResponder($params);
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
            $distributer->init('Account', 'Group', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer);
        /** assert */
            $responder = $provider->getCommitResponder($params);
            $this->assertTrue($responder->toggle, $responder->msg);

    }
}