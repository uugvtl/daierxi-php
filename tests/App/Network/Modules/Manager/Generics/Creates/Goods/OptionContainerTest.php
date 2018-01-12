<?php
namespace App\Network\Modules\Manager\Generics\Creates\Goods;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 18:54
 *
 * Class OptionContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Goods
 */
class OptionContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'option_id'         =>1,
                'prop_id'           =>'31',
                'text'              =>'测试测试'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Option', 'Create', ClassConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->setGenericContainerPrefix(ClassConst::PERSIST_PREFIX)->getCreateContainer($params);
        /** assert */
//            $container->getGenericInjecter()->useGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_modify_for_save()
    {
        /** arrange */
            $params = [
                'option_id'         =>1,
                'prop_id'           =>'31',
                'text'              =>'测试测试'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Option', 'Modify', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_remove_for_save()
    {
        /** arrange */
            $params = [1];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Option', 'Remove', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}