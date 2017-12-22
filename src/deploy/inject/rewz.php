<?php
use Phalcon\Db\Adapter\Pdo\Mysql;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/6/1
 * Time: 14:38
 */
$config = require CONFIG_PATH . '/rewz.php';
$db = new Mysql(array(
    "host"      => $config['host'],
    "username"  => $config['username'],
    "password"  => $config['password'],
    "dbname"    => $config['name'],
    'charset'   => $config['charset'],
    'options'   => array(
        PDO::ATTR_AUTOCOMMIT    => false,
        PDO::ATTR_PERSISTENT    => false
    )
));
return $db;