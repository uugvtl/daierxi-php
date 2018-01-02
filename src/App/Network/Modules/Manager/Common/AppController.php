<?php
namespace App\Network\Modules\Manager\Common;
use App\Network\Modules\ModuleController;
use Phalcon\Dispatcher;
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