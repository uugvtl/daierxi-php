<?php
namespace App\Console\Modules\Mission;
use Phalcon\DiInterface;
/**
 * 模块引导文件
 * User: leon
 * Date: 16/8/30
 * Time: 14:03
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
        $di->set('dispatcher', function(){
            return require INJECT_PATH.'/console/mission/dispatcher.php';
        }, true);
    }
}