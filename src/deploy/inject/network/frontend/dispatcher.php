<?php
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager          as EventsManager;
use App\Network\Modules\Frontend\Events\SecurityEvent;
use App\Network\Modules\Frontend\Events\NotFoundEvent;

$eventsManager = new EventsManager();

/**
 * Handle exceptions and not-found exceptions using NotFoundPlugin
 * 404时，优先级最高
 */
$eventsManager->attach('dispatch:beforeNotFoundAction', new NotFoundEvent());

/**
 * Handle exceptions and not-found exceptions using NotFoundPlugin
 * 如果出现异常，先处理，beforeExecuteRoute 此处理在上面的事件之后
 */
$eventsManager->attach('dispatch:beforeException', new NotFoundEvent());

/**
 * Check if the user is allowed to access certain action using the SecurityPlugin
 * 正常情况下，此优先级最高
 */
$eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityEvent());

$dispatcher = new Dispatcher();
$dispatcher->setEventsManager($eventsManager);
$dispatcher->setDefaultNamespace(FRONTEND_NS . '\Controllers');
return $dispatcher;