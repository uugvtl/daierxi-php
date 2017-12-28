<?php
session_start();
ob_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

define('TESTS_PATH', __DIR__);
define('SRC_PATH',  realpath(TESTS_PATH.'/../src'));                //项目目录
set_include_path(
    TESTS_PATH . PATH_SEPARATOR . get_include_path()
);

require_once SRC_PATH . '/deploy/const/unittest.php';
require_once DEPLOY_PATH. '/loader.php';                                            //载入loader配置文件

// Required for phalcon/incubator
require_once __DIR__ . "/../utils/vendor/autoload.php";