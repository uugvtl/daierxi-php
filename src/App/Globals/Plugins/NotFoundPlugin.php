<?php
namespace App\Globals\Plugins;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Exception;

/**
 * 异常事件处理基类
 * User: leon
 * Date: 2016/11/17
 * Time: 12:48
 *
 * Class NotFoundPlugin
 * @package App\Globals\Plugins
 */
class NotFoundPlugin extends Plugin
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