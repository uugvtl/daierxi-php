<?php
namespace App\Network\Modules\Manager\Generics\Creates\Area;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 15:02
 *
 * Class StreetContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Area
 */
class StreetContainerTest extends AppTestCase
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'street_id'            => '1',
                'district_id'          => '820202',
                'street_name'          => '测试测试'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Area\Street', 'Create', ClassConst::CLASS_PREFIX);

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
                'street_id'            => '1',
                'district_id'          => '820202',
                'street_name'          => '测试测试1'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Area\Street', 'Modify', ClassConst::CLASS_PREFIX);

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
            $params = [1];
            $distributer = Distributer::getInstance();
            $distributer->init('Area\Street', 'Remove', ClassConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}