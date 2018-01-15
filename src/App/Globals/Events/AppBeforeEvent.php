<?php
namespace App\Globals\Events;
use Exception;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 17:18
 *
 * Class ExceptionEvent
 * @package App\Globals\Events
 */
class AppBeforeEvent
{
    /**
     * 页面404处理
     * @param Event $event              事件实例
     * @param Dispatcher $dispatcher    调度器实例
     * @return bool                     返回true时，程序继续，返回false时，程序中断
     */
    public function beforeNotFoundAction(Event $event, Dispatcher $dispatcher)
    {
        $toggle = true;

        if($toggle)
        {
            $dispatcher->forward(array(
                'controller' => 'errors',
                'action' => 'show404'
            ));
            $toggle = false;
        }

        unset($event, $dispatcher);
        return $toggle;

    }


    /**
     * 异常处理--开发与测试的时候，需要把异常显示出来，而正式上线的时候，需要把异常作为日志保存下来。
     * @param Event $event              事件实例
     * @param Dispatcher $dispatcher    调度器实例
     * @param Exception $exception      异常实例
     * @throws Exception
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        unset($event, $dispatcher);
        throw $exception;
    }

}