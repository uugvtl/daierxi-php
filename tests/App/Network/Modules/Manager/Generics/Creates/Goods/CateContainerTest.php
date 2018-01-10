<?php
namespace App\Network\Modules\Manager\Generics\Creates\Goods;
use App\Datasets\Consts\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 18:54
 *
 * Class CateContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Goods
 */
class CateContainerTest extends AppTestCase
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'cate_id'           =>'86',
                'parent_id'         =>'0',
                'depth'             =>'1',
                'cate_name'         =>'测试',
                'seo_title'         =>'测试',
                'seo_keywords'      =>'测试',
                'seo_description'   =>'测试',
                'sort_order'        =>'255',
                'disabled'          =>'0'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Cate', 'Create', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCreateContainer($params);
        /** assert */
            $container->getGenericInjecter()->setGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_update_for_save()
    {
        /** arrange */
            $params = [
                'cate_id'           =>'86',
                'parent_id'         =>'0',
                'depth'             =>'1',
                'cate_name'         =>'测试',
                'seo_title'         =>'测试',
                'seo_keywords'      =>'测试',
                'seo_description'   =>'测试',
                'sort_order'        =>'255',
                'disabled'          =>'0'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Cate', 'Modify', DataConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    /**
     * 还原数据
     */
    public function test_delete_for_save()
    {
        /** arrange */
            $params = [86];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Cate', 'Remove', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}