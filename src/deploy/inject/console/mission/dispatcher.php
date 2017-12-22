<?php
use Phalcon\Cli\Dispatcher;
$dispatcher = new Dispatcher();
$dispatcher->setEventsManager($eventsManager);
$dispatcher->setDefaultNamespace(MISSION_NS . '\Tasks');
return $dispatcher;