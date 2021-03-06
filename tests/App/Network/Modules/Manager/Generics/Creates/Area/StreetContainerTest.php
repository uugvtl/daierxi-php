<?php
namespace App\Network\Modules\Manager\Generics\Creates\Area;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 15:02
 *
 * Class StreetContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Area
 */
class StreetContainerTest extends AppUnitTest
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
            $distributer->init('Area\Street', 'Create', ClassPrefix::APP);

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
                'street_id'            => '1',
                'district_id'          => '820202',
                'street_name'          => '测试测试1'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Area\Street', 'Modify', ClassPrefix::APP);

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
            $distributer->init('Area\Street', 'Remove', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}