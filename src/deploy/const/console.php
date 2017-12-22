<?php
/**
 * 控制台常量定义文件
 * User: leon
 * Date: 16/8/24
 * Time: 15:47
 */
require_once SRC_PATH       . '/deploy/const/system.php';
require_once CONST_PATH     . '/const_wan.php';
require_once CONST_PATH     . '/custom.php';

define('SELECTMODE',            'Search');                                          //是运行在cli还是net的平台配置

define('MISSION_PATH',          CONSOLE_PATH . '/Modules/Mission');

define('CONSOLE_NS',            APP_NS       . '\Console');                         //控制台程序命名空间
define('MODULES_NS',            CONSOLE_NS   . '\Modules');                         //控制台各模块的命名空间

define('MISSION_NS',            MODULES_NS   . '\Mission');                         //console任务模块


require_once CONST_PATH.'/const_rear.php';

