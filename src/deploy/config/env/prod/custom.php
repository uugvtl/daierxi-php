<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 16/9/6
 * Time: 20:03
 */
define('SESSION_COOKIE_DOMAIN', '.daierxi.com');
ini_set("session.cookie_domain",SESSION_COOKIE_DOMAIN);
session_name(md5(SESSION_COOKIE_DOMAIN));