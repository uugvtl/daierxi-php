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
                'brand_symbol'          =>'testtesttest',
                'brand_rank'            =>'255',
                'company_name'          =>'testtesttest',
                'alias_name'            =>'ojjsdjfdjfoasdjo',
                'is_personal'           =>'1',
                'is_remove'             =>'0'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Entity', 'Create', ClassPrefix::APP);

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
                'brand_id'              =>'1',
                'brand_name'            =>'测试*测试*测试1',
                'brand_symbol'          =>'testtesttest',
                'brand_rank'            =>'255',
                'company_name'          =>'testtesttest',
                'alias_name'            =>'ojjsdjfdjfoasdjo',
                'is_personal'           =>'1',
                'is_remove'             =>'0'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Entity', 'Modify', ClassPrefix::APP);

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
            $distributer->init('Brand\Entity', 'Remove', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle);
    }


}