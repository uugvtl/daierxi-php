<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/2/28
 * Time: 16:19
 */
/* 前端模块 router BEGIN */
$router->add('/', array(
    'module'        => 'frontend',
    'controller'    => 'Index',
    'action'        => 'index'
));

$router->add('/frontend', array(
    'module'        => 'frontend',
    'controller'    => 'Index',
    'action'        => 'index'
));
/* 前端模块 router END */

// Set 404 paths
$router->notFound(
    array(
        'module'        => 'frontend',
        'controller'    => 'Index',
        'action'        => 'show404'
    )
);