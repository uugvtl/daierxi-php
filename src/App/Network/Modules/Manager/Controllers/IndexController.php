<?php
namespace App\Network\Modules\Manager\Controllers;
use App\Network\Modules\ModuleController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/16
 * Time: 23:09
 *
 * Class IndexController
 * @package App\Network\Modules\Manager\Controllers
 */
class IndexController extends ModuleController
{
//    /**
//     * 初始化控制器
//     */
//    public function initialize()
//    {
//        $distributer = DispatcherFounder::getInstance($this->dispatcher, $this->dispatcher->getControllerName());
//        $this->provider = ManagerContainerProvider::getInstance();
//        $this->provider->setDistributer($distributer);
//        $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
//        $this->view->enable();
//    }


    /**
     * 登入界面
     */
    public function indexAction()
    {
        echo __CLASS__;
    }

}