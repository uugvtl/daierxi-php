<?php
namespace App\Network\Modules\Manager\Generics\Creates\Goods;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 18:55
 *
 * Class EntityContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Goods
 */
class EntityContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'supplier_id'           =>'1',
                'brand_id'              =>'31',

                'goods_id'              =>'10',
                'prop_ids'              =>'2,6',

                'one_cate_id'           =>'1',
                'two_cate_id'           =>'9',
                'three_cate_id'         =>'11',

                'rule_id'               =>'7',
                'goods_name'            =>'测试测试',
                'goods_desc'            =>'测试描述',
                'default_sku'           =>'1',

                'return_policy'         =>'1',
                'sort_order'            =>'255',
                'is_retail'             =>'1',
                'is_supply'             =>'1',
                'goods_channel'         =>'1',
                'goods_status'          =>'1'


            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Entity', 'Create', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCreateContainer($params);
        /** assert */
            $responder = $container->setBaseServicePrefix(ClassConst::CLASS_PREFIX)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_modify_for_save()
    {
        /** arrange */
            $params = [
                'goods_id'              =>'10',
                'one_cate_id'           =>'1',
                'two_cate_id'           =>'9',
                'three_cate_id'         =>'11',

                'rule_id'               =>'7',
                'goods_name'            =>'测试',
                'goods_desc'            =>'255',
                'default_sku'           =>'0',

                'return_policy'         =>'1',
                'sort_order'            =>'255',
                'is_retail'             =>'1',
                'is_supply'             =>'1',
                'goods_channel'         =>'1',
                'goods_status'          =>'2'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Entity', 'Modify', ClassConst::CLASS_PREFIX);

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
            $params = [10];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Entity', 'Remove', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}