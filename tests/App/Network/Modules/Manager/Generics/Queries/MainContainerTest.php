<?php
namespace App\Network\Modules\Manager\Generics\Queries;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 22:32
 *
 * Class MainContainerTest
 * @package App\Network\Modules\Manager\Generics\Queries
 */
class MainContainerTest extends AppUnitTest
{

    public function test_get_menu_list()
    {
        /** arrange */
            $params = [];
            $distributer = Distributer::getInstance();
            $distributer->init('Main', 'Menu', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getQueryContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_get_mo_list()
    {
        /** arrange */
            $params = [
                'menu_id'=>4
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Main', 'Mo', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getQueryContainer($params);
        /** assert */
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }

}