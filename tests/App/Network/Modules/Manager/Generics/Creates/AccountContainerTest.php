<?php
namespace App\Network\Modules\Manager\Generics\Creates;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 23:50
 *
 * Class AccountContainerTest
 * @package App\Network\Modules\Manager\Generics\Creates
 */
class AccountContainerTest extends AppUnitTest
{
    public function test_create_for_save()
    {
        /** arrange */
            $params = [
                'manager_id'    =>14,
                'manager_name'  =>'测试测试',
                'password'      =>'123456',
                'real_name'     =>'测试工程师',
                'birthday'      =>'1982-03-10',
                'group_id'      =>'43',
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Account', 'Create', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->setGenericContainerPrefix(ClassPrefix::PERSIST)->getCreateContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_modify_for_save()
    {
        /** arrange */
            $params = [
                'manager_id'    =>14,
                'manager_name'  =>'测试测试1',
                'password'      =>'123456',
                'real_name'     =>'测试工程师1',
                'birthday'      =>'1982-03-10',
                'group_id'      =>'43',
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Account', 'Modify', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }


    
    public function test_delete_for_save()
    {
        /** arrange */
            $params = [14];
            $distributer = Distributer::getInstance();
            $distributer->init('Account', 'Remove', ClassPrefix::APP);

        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}