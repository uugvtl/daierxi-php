<?php
namespace App\Network\Modules\Manager\Generics\Creates\Brand;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 20:24
 *
 * Class EntityContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Brand
 */
class EntityContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'brand_id'              =>'1',
                'brand_name'            =>'测试*测试*测试',
                'brand_code'            =>'testtesttest',
                'brand_tag'             =>'1',
                'brand_rank'            =>'255',
                'brand_type_id'         =>'13',
                'brand_shop_name'       =>'asdfsadfsadfsdfasdfdfdfdf',
                'brand_company_name'    =>'testtesttest',
                'channel_code'          =>'01,02',
                'alias_brand_name'      =>'ojjsdjfdjfoasdjo',
                'brand_thumb_common'    =>'',
                'is_personal'           =>'1',
                'is_supply'             =>'1',
                'is_remove'             =>'0'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Entity', 'Create', ClassConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->setGenericContainerPrefix(ClassConst::PERSIST_PREFIX)->getCreateContainer($params);
        /** assert */
            $container->getGenericInjecter()->useGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle);
    }

    public function test_update_for_save()
    {
        /** arrange */
            $params = [
                'brand_id'              =>'1',
                'brand_name'            =>'测试*测试*测试1',
                'brand_code'            =>'testtesttest',
                'brand_tag'             =>'1',
                'brand_rank'            =>'255',
                'brand_type_id'         =>'13',
                'brand_shop_name'       =>'asdfsadfsadfsdfasdfdfdfdf',
                'brand_company_name'    =>'testtesttest',
                'channel_code'          =>'01,02',
                'alias_brand_name'      =>'ojjsdjfdjfoasdjo',
                'brand_thumb_common'    =>'',
                'is_personal'           =>'1',
                'is_supply'             =>'1',
                'is_remove'             =>'0'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Entity', 'Modify', ClassConst::CLASS_PREFIX);

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
            $distributer->init('Brand\Entity', 'Remove', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle);
    }


}