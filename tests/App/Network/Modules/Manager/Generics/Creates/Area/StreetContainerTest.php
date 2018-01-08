<?php
namespace App\Network\Modules\Manager\Generics\Creates\Area;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 15:02
 *
 * Class StreetContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Area
 */
class StreetContainerTest extends UnitTestCase
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
            $distributer->init('Area\Street', 'Create', DataConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer)->setGeneralize(YES);
        /** assert */
            $responder = $provider->getCreateResponder($params);
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
            $distributer->init('Area\Street', 'Modify', DataConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer);
        /** assert */
            $responder = $provider->getCommitResponder($params);
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
            $distributer->init('Area\Street', 'Remove', DataConst::CLASS_PREFIX);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer);
        /** assert */
            $resultBo = $provider->getRemoveResponder($params);
            $this->assertTrue($resultBo->toggle, $resultBo->msg);
    }
}