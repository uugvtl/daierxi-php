<?php
$security = new Phalcon\Security();
/**
 * 安全注入类
 * User: leon
 * Date: 16/8/25
 * Time: 14:25
 */
//Set the password hashing factor to 12 rounds
$security->setWorkFactor(12);
return $security;