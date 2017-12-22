<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/16
 * Time: 21:14
 */
return array(
    'admin' => array(
        'className' => ADMIN_NS.'\Module',
        'path' => ADMIN_PATH. '/Module.php'
    ),
    'ajax' => array(
        'className' => AJAX_NS.'\Module',
        'path' => AJAX_PATH. '/Module.php'
    ),
    'frontend' => array(
        'className' => FRONTEND_NS.'\Module',
        'path' => FRONTEND_PATH.'/Module.php'
    ),
    'backend' => array(
        'className' => BACKEND_NS.'\Module',
        'path' => BACKEND_PATH. '/Module.php'
    ),
    'manager'=>array(
        'className' => MANAGER_NS.'\Module',
        'path' => MANAGER_PATH. '/Module.php'
    ),
    'mobile'=>array(
        'className' => MOBILE_NS.'\Module',
        'path' => MOBILE_PATH. '/Module.php'
    ),
    'wechat'=>array(
        'className' => WECHAT_NS.'\Module',
        'path' => WECHAT_PATH. '/Module.php'
    )
);