<?php
namespace App\Network\Modules\Manager\Generics\Queries;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 18:38
 *
 * Class RuleContainerTest
 * @package App\Network\Modules\Manager\Generics\Queries
 */
class RuleContainerTest extends AppUnitTest
{
    public function test_get_menu_list()
    {
        /** arrange */
        $params = [
            'team_id'=>1
        ];
        $distributer = Distributer::getInstance();
        $distributer->init('Rule', 'Menu', ClassPrefix::APP);
        /** act */
        $provider = ManagerContainerProvider::getInstance();
        $container = $provider->init($distributer)->getQueryContainer($params);
        /** assert */
        $responder = $container->useGeneralize(YES)->get();
        $this->assertTrue($responder->toggle, $responder->msg);
    }

    public function test_get_mo_list()
    {
        /** arrange */
        $params = [
            'team_id'=>1,
            'menu_id'=>8
        ];
        $distributer = Distributer::getInstance();
        $distributer->init('Rule', 'Mo', ClassPrefix::APP);
        /** act */
        $provider = ManagerContainerProvider::getInstance();
        $container = $provider->init($distributer)->getQueryContainer($params);
        /** assert */
        $responder = $container->useGeneralize(YES)->get();
        $this->assertTrue($responder->toggle, $responder->msg);
    }
}