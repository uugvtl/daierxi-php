<?php
use Phalcon\Cli\Router;
/**
 * 路由器服务初始化
 * User: Leon
 * Date: 2016/4/20
 * Time: 18:39
 */
$router = new Router(false);

require_once INJECT_PATH.'/console/mission/router.php';
$router->add('/:module/:task/:action/:params', array(
    'module'        => 1,
    'task'          => 2,
    'action'        => 3,
    'params'        => 4
));
return $router;