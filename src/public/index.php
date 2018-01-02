<?php
use Phalcon\Mvc\Application as WebApplication;
use Phalcon\DI\FactoryDefault;
use App\Helpers\ErrorsHelper;
require_once '../bootstrap.php';
class Application extends WebApplication
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {
        $di = new FactoryDefault();

        $di->set('config', function (){
            return require INJECT_PATH . '/config.php';
        }, true);

        /**
         * Registering a router
         */
        $di->set('router', function(){
            return require INJECT_PATH . '/network/router.php';
        }, true);

        /* 引入安全助手 BEGIN */
        $di->set('security', function(){
            return require INJECT_PATH . '/security.php';
        }, true);
        /* 引入安全助手 END */


        $di->set('crypt', function (){
            return require INJECT_PATH . '/crypt.php';
        }, true);

        /**
         * Start the session the first time some component request the session service
         */
        $di->set('session', function(){
            return require INJECT_PATH . '/session.php';
        }, true);

        // 建立flash服务
        $di->set('flash', function () {
            return require INJECT_PATH . '/network/flash.php';
        }, true);

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', function (){
            return require INJECT_PATH . '/db.php';
        }, true);

        /**
         * 当有一个请求时的参数类，全局只能有一个。
         */
        $di->set('parameter',function(){
            return require INJECT_PATH . '/parameter.php';
        }, true);

        /**
         * Handle the request
         */
        $this->setDI($di);

    }

    /**
     * 网站程序入口
     */
    public function main()
    {
        $this->registerServices();

        $modules = require DEPLOY_PATH.'/modules/network.php';

        /**
         * Register application modules
         */
        $this->registerModules($modules);

        echo $this->handle()->getContent();
    }
}

try {
    $application = new Application();
    $application->main();
}
catch (Exception $e){

    if(extension_loaded('xdebug'))
    {
        $errorHelper = ErrorsHelper::getInstance();
        echo $errorHelper->formatExceptionTrace($e->getTraceAsString());
    }
    else
    {
        $application->dispatcher->forward([
            'module'        => 'frontend',
            'controller'    => 'Index',
            'action'        => 'index'

        ]);
    }
}