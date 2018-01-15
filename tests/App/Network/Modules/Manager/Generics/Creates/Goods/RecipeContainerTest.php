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
 * Time: 13:44
 *
 * Class RecipeContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Goods
 */
class RecipeContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'goods_id'          =>'1',
                'deionized_water'   =>'81.095',
                'sku_material_rate' =>[
                    'LCQP0023'      => 0.2,
                    'JDTM0016'      => 0.05,
                    'HLSL0017'      => 2,
                    'LJDF0024'      => 1,
                    'HTTC0018'      => 4,
                    'XLMY0015'      => 9.5,
                    'SFRT0021'      => 0.055,
                    'LCEB0046'      => 1.2,
                    'LCBY0047'	    => 0.4,
                    'HTYF0022'	    => 0.5
                ]
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Recipe', 'Create', ClassPrefix::APP);
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
                'goods_id'          =>'1',
                'deionized_water'   =>'81.095',
                'sku_material_rate' =>[
                    'LCQP0023'      => 0.2,
                    'JDTM0016'      => 0.05,
                    'HLSL0017'      => 2,
                    'LJDF0024'      => 1,
                    'HTTC0018'      => 4,
                    'XLMY0015'      => 9.5,
                    'SFRT0021'      => 0.055,
                    'LCEB0046'      => 1.2,
                    'LCBY0047'	    => 0.4,
                    'HTYF0022'	    => 0.5
                ]
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Recipe', 'Modify', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_delete_for_save()
    {
        /** arrange */
            $params = [1];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Recipe', 'Remove', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}