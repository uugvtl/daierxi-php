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
 * Time: 13:48
 *
 * Class DistrictContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates\Area
 */
class DistrictContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'id'            =>'820202',
                'name'          =>'测试测试',
                'parent_id'     =>'820200',
                'short_name'    =>'测试',
                'depth'         =>'3',
                'city_code'     =>'820202',
                'zip_code'      =>'820202',
                'merger_name'   =>'中国,澳门特别行政区,氹仔岛,测试测试',
                'lng'           =>'113.5653030',
                'lat'           =>'22.1490290',
                'pinyin'        =>'testtest',
                'leaf'          =>'1',
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Area\District', 'Create', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->setGenericContainerPrefix(ClassPrefix::PERSIST)->getCreateContainer($params);
        /** assert */
            $container->getGenericInjecter()->useGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_update_for_save()
    {
        /** arrange */
            $params = [
                'id'            =>'820202',
                'name'          =>'测试测试1',
                'parent_id'     =>'820200',
                'short_name'    =>'测试',
                'depth'         =>'3',
                'city_code'     =>'820202',
                'zip_code'      =>'820202',
                'merger_name'   =>'中国,澳门特别行政区,氹仔岛,测试测试',
                'lng'           =>'113.5653030',
                'lat'           =>'22.1490290',
                'pinyin'        =>'testtest',
                'leaf'          =>'1',
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Area\District', 'Modify', ClassPrefix::APP);

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
            $params = [820202];

            $distributer = Distributer::getInstance();
            $distributer->init('Area\District', 'Remove', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}