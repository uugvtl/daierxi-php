<?php
namespace App\Network\Modules\Frontend\Common;
use App\Network\Modules\ModuleController;
use Phalcon\Mvc\Dispatcher;
/**
 * WEB程序前端模块控制器基类
 * User: leon
 * Date: 16/8/25
 * Time: 15:10
 */
abstract class AppController extends ModuleController
{
    /**
     * 每次请求都会运行此事件方法--包括Action未找到
     * @param Dispatcher $dispatcher
     * @return bool                                 返回true时，程序继续，返回false时，程序中断
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        unset($dispatcher);
        return true;
    }
}