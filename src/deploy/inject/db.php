<?php
use Phalcon\Db\Adapter\Pdo\Mysql;
/**
 * 数据库类注入类
 * User: leon
 * Date: 16/8/25
 * Time: 13:54
 */

$config = require CONFIG_PATH . '/db.php';
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
