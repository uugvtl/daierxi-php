<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Index;
use App\Datesets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 22:40
 *
 * Class IndexContainerTest
 * @package App\Network\Modules\Manager\Generics\Modifies\Index
 */
class IndexContainerTest extends UnitTestCase
{

    public function test_get_list_for_index()
    {
        /** arrange */
            $params = [];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer)->setGeneralize(YES)->setPrefixString('Index');
        /** assert */
            $resultBo = $provider->getCommitResponder($params);
            $this->assertFalse($resultBo->toggle);
    }

    public function test_get_list_for_cookie()
    {
        /** arrange */
            $params = [];
            $distributer = Distributer::getInstance();
            $distributer->init('Index', 'Index', DataConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $provider->init($distributer)->setGeneralize(YES)->setPrefixString('Cookie');
        /** assert */
            $resultBo = $provider->getCommitResponder($params);
            $this->assertFalse($resultBo->toggle);
    }
}