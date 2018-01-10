<?php
namespace App\Network\Modules\Manager\Generics\Removes;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppTestCase;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 12:54
 *
 * Class CacheContainerTest
 * @package App\Network\Modules\Manager\Generics\Removes
 */
class CacheContainerTest extends AppTestCase
{
    public function test_clear_cache()
    {
        /** arrange */
            $params = [
                'account'   =>'1',
                'password'  =>'a'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Cache', 'clear', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $container->getGenericInjecter()->setGeneralize(YES);
            $responder = $container->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}