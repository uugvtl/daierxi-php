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
 * Time: 15:26
 *
 * Class SkuContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Goods
 */
class SkuContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'goods_id'          =>16,
                'sku_id'            =>'12013',
                'sku_sn'            =>'testtest',
                'sku_name'          =>'测试测试',
                'sku_desc'          =>'测试测试',
                'sku_nature'        =>'1',
                'sku_type'          =>'1',

                'sku_market_price'  =>'1',
                'sku_retail_price'  =>'2',
                'sku_vip_price'     =>'3',
                'cost_price'        =>'4',
                'option'            =>[
                    1=>30,
                    2=>4620
                ]

            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Sku', 'Create', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCreateContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }


    public function test_modify_for_save()
    {
        /** arrange */
            $params = [
                'goods_id'          =>16,
                'sku_id'            =>'12013',
                'sku_sn'            =>'0820-1-38',
                'sku_name'          =>'黑色牛皮黑色獭兔毛短靴',
                'sku_desc'          =>'黑色38码',
                'sku_nature'        =>'1',
                'sku_type'          =>'1',
                'option'            =>[
                    1=>3,
                    2=>4556
                ]

            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Sku', 'Modify', ClassPrefix::APP);

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
            $params = [12013];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Sku', 'Remove', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}