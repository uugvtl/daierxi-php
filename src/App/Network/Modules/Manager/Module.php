<?php
namespace App\Network\Modules\Manager;
use Phalcon\Mvc\Url;
use Phalcon\DiInterface;
use stdClass;
/**
 * 移动端代码模块入口类
 * User: leon
 * Date: 16/8/24
 * Time: 16:35
 */
class Module
{
    /**
     * 注册指定模块的加载文件
     */
    public function registerAutoloaders(){}

    /**
     * 注册指定模块的服务
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        $di->set('dispatcher', function () {
            return require INJECT_PATH.'/network/manager/dispatcher.php';
        }, true);

        /* Setting up the view component BEGIN  */
        $di->set('view', function (){
            return require INJECT_PATH.'/network/manager/view.php';
        }, true);
        /* Setting up the view component END  */

        $di->set('login', function (){
            return new stdClass();
        }, true);

        /**
         * The URL component is used to generate all kind of urls in the application
         */
        $di->set('url', function() {
            $url = new Url();
            $url->setBaseUri('/manager/');
            $url->setStaticBaseUri(ASSETS_URI);
            return $url;
        }, true);
    }
}


