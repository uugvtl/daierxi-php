<?php
namespace App\Network\Modules\Manager\Generics\Removes;
use App\Datasets\Consts\ClassPrefix;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 12:54
 *
 * Class CacheContainerTest
 * @package App\Network\Modules\Manager\Generics\Removes
 */
class CacheContainerUnitTest extends AppUnitTest
{
    public function test_clear_cache()
    {
        /** arrange */
            $params = [
                'account'   =>'1',
                'password'  =>'a'
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Cache', 'clear', ClassPrefix::APP);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getRemoveContainer($params);
        /** assert */
            $responder = $container->useGeneralize(YES)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}