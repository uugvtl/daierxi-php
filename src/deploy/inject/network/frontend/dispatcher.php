<?php
/**
 * 调度器注入类
 * User: leon
 * Date: 16/8/25
 * Time: 15:22
 */
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager          as EventsManager;
use App\Network\Modules\Frontend\Plugins\SecurityPlugin;
use App\Network\Modules\Frontend\Plugins\NotFoundPlugin;

$eventsManager = new EventsManager();
/**
 * Check if the user is allowed to access certain action using the SecurityPlugin
 * 正常情况下，此优先级最高
 */
$eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin());

/**
 * Handle exceptions and not-found exceptions using NotFoundPlugin
 * 如果出现异常，先处理，beforeExecuteRoute 此处理在上面的事件之后
 */
$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin());

/**
 * Handle exceptions and not-found exceptions using NotFoundPlugin
 * 404时，优先级最高
 */
$eventsManager->attach('dispatch:beforeNotFoundAction', new NotFoundPlugin());

$dispatcher = new Dispatcher();
$dispatcher->setEventsManager($eventsManager);
$dispatcher->setDefaultNamespace(FRONTEND_NS . '\Controllers');
return $dispatcher;