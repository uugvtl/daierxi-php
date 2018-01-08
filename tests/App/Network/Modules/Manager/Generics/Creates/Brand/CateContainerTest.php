<?php
namespace App\Network\Modules\Manager\Generics\Creates\Brand;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 20:24
 *
 * Class CateContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Brand
 */
class CateContainerTest extends UnitTestCase
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
            $distributer->init('Brand\Cate', 'Create', DataConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCreateContainer($params);
        /** assert */
            $container->getGenericInjecter()->setGeneralize(YES);
            $responder = $container->get();
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
            $distributer->init('Brand\Cate', 'Modify', DataConst::CLASS_PREFIX);

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
            $distributer->init('Brand\Cate', 'Remove', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle);
    }
}