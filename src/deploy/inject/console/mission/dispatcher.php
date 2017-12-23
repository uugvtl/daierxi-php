<?php
use Phalcon\Cli\Dispatcher;
use Phalcon\Events\Manager          as EventsManager;
$dispatcher = new Dispatcher();
$eventsManager = new EventsManager();
$dispatcher->setEventsManager($eventsManager);
$dispatcher->setDefaultNamespace(MISSION_NS . '\Tasks');
return $dispatcher;