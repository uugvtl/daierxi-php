<?php
namespace App\Network\Modules\Manager\Generics\Removes;
use App\Datasets\DataConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use UnitTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 12:54
 *
 * Class CacheContainerTest
 * @package App\Network\Modules\Manager\Generics\Removes
 */
class CacheContainerTest extends UnitTestCase
{
    public function test_clear_cache()
    {
        /** arrange */
        $params = [
            'account'   =>'1',
            'password'  =>'a'
        ];
        $distributer = Distributer::getInstance();
        $distributer->init('Cache', 'clear', DataConst::CLASS_PREFIX);
        /** act */
        $provider = ManagerContainerProvider::getInstance();
        $provider->init($distributer)->setGeneralize(YES);
        /** assert */
        $responder = $provider->getRemoveResponder($params);
        $this->assertTrue($responder->toggle, $responder->msg);
    }
}