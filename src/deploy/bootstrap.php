<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 17/11/17
 * Time: 20:32
 */
extension_loaded('xdebug')?
    error_reporting(E_ALL):
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if (isset($_GET['_url'])) $_GET['_url'] = strtolower($_GET['_url']);

define('SRC_PATH',  str_replace('\\', '/', realpath(__DIR__.'/..')));                //项目目录
if(defined('CLI'))
{
    require_once SRC_PATH . '/deploy/const/console.php';                            //载入常量定义文件
    require_once SCAFFOLD_PATH. '/loaders/console/globals.php';                     //载入loader配置文件
}
else
{
    require_once SRC_PATH . '/deploy/const/network.php';                            //载入常量定义文件
    require_once SCAFFOLD_PATH. '/loaders/network/globals.php';                     //载入loader配置
}