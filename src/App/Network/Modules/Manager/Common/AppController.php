<?php
namespace App\Network\Modules\Manager\Common;
use App\Entities\Bizbos\Signin\AccountBaseBO;
use App\Network\Modules\Manager\Events\SigninEvent;
use App\Network\Providers\ManagerContainerProvider;
use Phalcon\Mvc\Dispatcher;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/16
 * Time: 23:10
 *
 * Class AppController
 * @package App\Network\Modules\Manager\Common
 * @property-read AccountBaseBO $account
 */
abstract class AppController extends ComController
{
    /**
     * 每次请求都会运行此事件方法--包括Action未找到
     * @param Dispatcher $dispatcher
     * @return bool                                 返回true时，程序继续，返回false时，程序中断
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {

        $signinEvent = SigninEvent::getInstance();
        $toggle = $signinEvent->init($this)
            ->beforeExecuteRoute($dispatcher, ManagerContainerProvider::class);

        if(!$toggle)
            $this->response->redirect();

        return $toggle;
    }
}