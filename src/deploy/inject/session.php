<?php
use Phalcon\Session\Adapter\Files   as SessionAdapter;
/**
 * 会话注入类
 * User: leon
 * Date: 16/8/25
 * Time: 14:17
 */
$session = new SessionAdapter();
$session->start();
return $session;