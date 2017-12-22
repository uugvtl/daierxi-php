<?php
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Route;
/**
 * 路由注入类
 * User: leon
 * Date: 16/8/25
 * Time: 14:29
 */
$router = new Router();

require_once INJECT_PATH.'/network/manager/router.php';
require_once INJECT_PATH.'/network/frontend/router.php';

$route = $router->add('/:module/:controller/:action/:params', array(
    'module'        => 1,
    'controller'    => 2,
    'action'        => 3,
    'params'        => 4
));/* @var $route Route */

$route->convert('controller', function($ctrl){
    $ctrl = ucwords(str_replace('_', ' ', $ctrl));
    $ctrl = str_replace(' ', '', $ctrl);
    return $ctrl;
})->convert('controller', function($ctrl){
    $ctrl = ucwords(str_replace('-', ' ', $ctrl));
    $ctrl = str_replace(' ', '\\', $ctrl);
    return $ctrl;
})->convert('action', function($action){
    return str_replace('-', '', $action);
});

$router->removeExtraSlashes(true);
return $router;