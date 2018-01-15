<?php
namespace App\Network\Modules\Manager\Generics\Creates\Goods;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 11:48
 *
 * Class PropContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Goods
 */
class PropContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'prop_id'           =>'31',
                'brand_ids'         =>'30,31,32',
                'prop_name'         =>'测试测试'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Prop', 'Create', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCreateContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_update_for_save()
    {
        /** arrange */
        $params = [
            'prop_id'           =>'31',
            'prop_name'         =>'测试测试'
        ];
        $distributer = Distributer::getInstance();
        $distributer->init('Goods\Prop', 'Modify', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

//    public function test_attach_for_save()
//    {
//        /** arrange */
//        $params = [
//            'prop_id'           =>'31',
//            'brand_ids'         =>'30,31,32'
//        ];
//        $distributeBuilder = DistributerFounder::getInstance('Goods\Prop', 'Attach', 'Prop');
//        /** act */
//        $provider = ManagerContainerProvider::getInstance();
//        $provider->setDistributer($distributeBuilder);
//        /** assert */
//        $resultBo = $provider->getCommitResult($params);
//        $this->assertTrue($resultBo->toggle);
//    }

    public function test_delete_for_save()
    {
        /** arrange */
        $params = [31];
        $distributer = Distributer::getInstance();
        $distributer->init('Goods\Prop', 'Remove', ClassPrefix::APP);
        /** act */
        $provider = ManagerContainerProvider::getInstance();
        $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
        $responder = $container->get();
        $this->assertTrue($responder->toggle, $responder->msg);
    }
}
