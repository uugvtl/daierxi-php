<?php
namespace App\Network\Modules\Manager\Generics\Creates\Brand;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 20:24
 *
 * Class CateContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Brand
 */
class CateContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'brand_type_id'         =>'1',
                'brand_type_name'       =>'测试*测试*测试',
                'brand_type_sortrank'   =>'255'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Cate', 'Create', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCreateContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle);
    }

    public function test_update_for_save()
    {
        /** arrange */
            $params = [
                'brand_type_id'         =>'1',
                'brand_type_name'       =>'测试*测试*测试1',
                'brand_type_sortrank'   =>'255'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Cate', 'Modify', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle);
    }

    /**
     * 还原数据
     */
    public function test_delete_for_save()
    {
        /** arrange */
            $params = [1];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Cate', 'Remove', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle);
    }
}