<?php
extension_loaded('xdebug')?
    error_reporting(E_ALL):
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
define('SRC_PATH',  str_replace('\\', '/', __DIR__));                               //项目目录
if(defined('CLI'))
{
    require_once SRC_PATH . '/deploy/const/console.php';                            //载入常量定义文件
}
else
{
    require_once SRC_PATH . '/deploy/const/network.php';                            //载入常量定义文件
}
require_once DEPLOY_PATH. '/loader.php';                                            //载入loader配置文件