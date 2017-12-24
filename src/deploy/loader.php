<?php
use Phalcon\Loader;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 16/8/25
 * Time: 17:49
 */
$loader = new Loader();
$loader->registerDirs(explode(':', get_include_path()), true);

$aNamespeces = require DEPLOY_PATH . '/namespaces.php';
$loader->registerNamespaces($aNamespeces, true);

$loader->register();