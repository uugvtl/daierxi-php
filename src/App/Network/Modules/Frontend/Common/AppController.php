<?php
namespace App\Network\Modules\Frontend\Common;
use App\Globals\Finals\Distributer;
use App\Network\Modules\ModuleController;
use App\Network\Providers\FrontendContainerProvider;
/**
 * WEB程序前端模块控制器基类
 * User: leon
 * Date: 16/8/25
 * Time: 15:10
 */
abstract class AppController extends ModuleController
{
    public function initialize()
    {
        $dispatcher = $this->dispatcher;
        $distributer = Distributer::getInstance();

        $ctrlName   = $dispatcher->getControllerName();
        $actName    = $dispatcher->getActionName();
        $fileName   = $dispatcher->getControllerName();

        $distributer->init($ctrlName, $actName, $fileName);

        $this->provider = FrontendContainerProvider::getInstance();
        $this->provider->init($distributer);
    }
}