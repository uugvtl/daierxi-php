<?php
/**
 * 系统常量定义文件
 * User: leon
 * Date: 16/8/24
 * Time: 15:35
 */
define('BACKSLASH',                         '\\');                                                  //反斜线常量定义
define('CACHE_LIFETIME',                    172800);                                                //缓存默认存储时间
define('DEFAULT_PASSWORD',                  88888888);                                              //默认登入密码
define('APP_PATH',                          SRC_PATH     . '/App');                                 //应用代码目录
define('PUBLIC_PATH',                       SRC_PATH     . '/public');                              //站点路径
define('ASSETS_PATH',                       PUBLIC_PATH  . '/assets');                              //资源路径

define('CONSOLE_PATH',                      APP_PATH     . '/Console');                             //控制台程序路径
define('FACTORIES_PATH',                    APP_PATH     . '/Factories');                           //工厂类路径
define('GLOBALS_PATH',                      APP_PATH     . '/Globals');                             //应用公共类路径
define('INTERFACES_PATH',                   APP_PATH     . '/Interfaces');                          //接口类路径
define('NETWORK_PATH',                      APP_PATH     . '/Network');                             //网络程序路径
define('PROGRAMMES_PATH',                   APP_PATH     . '/Programmes');                          //代码公共类路径


define('DEPLOY_PATH',                       SRC_PATH     . '/deploy');                              //部署路径
define('CONFIG_PATH',                       DEPLOY_PATH  . '/config');                              //公共配置路径
define('INITS_PATH',                        DEPLOY_PATH  . '/inits');                               //公共常量路径
define('CONST_PATH',                        DEPLOY_PATH  . '/const');                               //公共常量路径
define('INJECT_PATH',                       DEPLOY_PATH  . '/inject');                              //公共注入类路径
define('SCAFFOLD_PATH',                     DEPLOY_PATH  . '/scaffold');                            //脚手架程序路径
define('MSGS_PATH',                         DEPLOY_PATH  . '/messages');                            //语言包路径
define('DATA_PATH',                         DEPLOY_PATH  . '/data');                                //相关数据路径：以数据表名称及字段名称分隔目录

define('LOGIN_USER',                        'Users');                                               //用户登陆标识
define('LOGIN_MEMBER',                      'Members');                                             //会员登陆标识
define('LOGIN_MANAGER',                     'Managers');                                            //公司员工或是合作伙伴标识
define('SUPER_MANAGER',                     1);                                                     //超级管理员ID

/* 目录相关常量定义 BEGIN */
define('RUNTIME_PATH',                      SRC_PATH    . '/runtime');                              //运行时目录
define('DEPENDENCY_CACHE_DIR',              RUNTIME_PATH . '/cache/dependency/');                   //缓存依赖目录
define('GENERAL_CACHE_DIR',                 RUNTIME_PATH . '/cache/general/');                      //共公数据缓存目录
/* 目录相关常量定义 FINISH */


define('APP_NS',                            'App');
define('DS',                                DIRECTORY_SEPARATOR);




