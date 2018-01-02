<?php
namespace App\Network\Modules\Manager\Events;
use App\Globals\Events\AppBeforeEvent;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/16
 * Time: 22:54
 *
 * Class SecurityPlugin
 * @package App\Network\Modules\Manager\Plugins
 */
class BeforeEvent extends AppBeforeEvent
{
    /**
     * 每次请求都会运行此事件方法--包括Action未找到
     * @param Event $event                          事件实例
     * @param Dispatcher $dispatcher                调度器实例
     * @return bool                                 返回true时，程序继续，返回false时，程序中断
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        unset($event);
        unset($dispatcher);
        return true;
    }
}