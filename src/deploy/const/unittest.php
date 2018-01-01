<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/26
 * Time: 23:28
 */
require_once SRC_PATH           . '/deploy/const/system.php';
require_once CONST_PATH         . '/constfront.php';
require_once CONST_PATH         . '/custom.php';

define('FRONTEND_PATH',         NETWORK_PATH . '/Modules/Frontend');
define('BACKEND_PATH',          NETWORK_PATH . '/Modules/Backend');
define('MANAGER_PATH',          NETWORK_PATH . '/Modules/Manager');
define('AJAX_PATH',             NETWORK_PATH . '/Modules/Ajax');
define('ADMIN_PATH',            NETWORK_PATH . '/Modules/Admin');
define('MOBILE_PATH',           NETWORK_PATH . '/Modules/Mobile');
define('WECHAT_PATH',           NETWORK_PATH . '/Modules/Wechat');

define('NETWORK_NS',            APP_NS       . '\Network');                         //WEB程序命名空间
define('MODULES_NS',            NETWORK_NS   . '\Modules');                         //WEB各模块的命名空间

define('FRONTEND_NS',           MODULES_NS   . '\Frontend');                        //network会员模块
define('BACKEND_NS',            MODULES_NS   . '\Backend');                         //network用户模块
define('MANAGER_NS',            MODULES_NS   . '\Manager');                         //network管理员模块
define('AJAX_NS',               MODULES_NS   . '\Ajax');                            //network异步模块
define('ADMIN_NS',              MODULES_NS   . '\Admin');                           //network管理员模块
define('MOBILE_NS',             MODULES_NS   . '\Mobile');                          //network移动模块
define('WECHAT_NS',             MODULES_NS   . '\Wechat');                          //network微信模块


require_once CONST_PATH . '/constback.php';