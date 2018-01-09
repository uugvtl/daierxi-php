<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Brand;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:45
 *
 * Class EntityContainerTest
 * @package App\Network\Modules\Manager\Generics\Modifies\Brand
 */
class EntityContainerTest extends AppTestCase
{
    public function test_upload_for_save()
    {
        /** arrange */
            $params = [
                'brand_id'              =>'67',
                'brand_thumb_common'    =>'upload/2017/02/23/original/2017223608422223486.jpg',
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Brand\Entity', 'Upload', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
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
            $distributer->init('Brand\Entity', 'Toggle', DataConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $container->getGenericInjecter()->setGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}