<?php
namespace App\Network\Modules\Manager\Common;
use App\Globals\Finals\Distributer;
use App\Network\Modules\ModuleController;
use App\Network\Providers\ManagerContainerProvider;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/16
 * Time: 23:10
 *
 * Class AppController
 * @package App\Network\Modules\Manager\Common
 */
abstract class AppController extends ModuleController
{
//    /**
//     * @param Dispatcher $dispatcher
//     * @return bool                         成功返回true,否则返回false
//     */
//    public function beforeExecuteRoute(Dispatcher $dispatcher)
//    {
//        $factory = FeatureFactory::getInstance();
//        $factory->construct($dispatcher->getModuleName(), 'Login');
//        $resultBo = $factory->createInstance()->launch();
//        unset($dispatcher);
//        return $resultBo->toggle;
//    }
//
    public function initialize()
    {
        $dispatcher = $this->dispatcher;
        $distributer = Distributer::getInstance();

        $ctrlName   = $dispatcher->getControllerName();
        $actName    = $dispatcher->getActionName();
        $fileName   = $dispatcher->getControllerName();

        $distributer->init($ctrlName, $actName, $fileName);

        $this->provider = ManagerContainerProvider::getInstance();
        $this->provider->init($distributer);
    }
}