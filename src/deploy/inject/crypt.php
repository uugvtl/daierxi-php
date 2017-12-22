<?php
/**
 * 加密注入类
 * User: leon
 * Date: 16/8/25
 * Time: 14:27
 */
$crypt = new Phalcon\Crypt();
if(method_exists($crypt, 'setMode'))
    $crypt->setMode('ofb');
$crypt->setKey('#5dj1$=dp?.ak/%j'); //使用你自己的key！
return $crypt;