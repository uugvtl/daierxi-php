<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Goods;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 21:47
 *
 * Class CateContainerTest
 * @package App\Network\Modules\Manager\Generics\Modifies\Goods
 */
class CateContainerTest extends AppTestCase
{
    public function test_upload_for_save()
    {
        /** arrange */
            $params = [
                'cate_id'       =>'86',
                'cate_thumb'    =>'upload/2017/02/23/original/2017223608422223486.jpg',
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Cate', 'Upload', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $container->getGenericInjecter()->setGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_toggle_for_save()
    {
        /** arrange */
            $params = [
                'disabled'=>1,
                'items'=>'2,5,6'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Cate', 'Toggle', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}