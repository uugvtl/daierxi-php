<?php
set_time_limit(0);
/**
 * 命令行程序入口
 * User: leon
 * Date: 16/8/24
 * Time: 17:22
 */
use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\CLI\Console as ConsoleApp;

define('CLI', 1);
require_once 'bootstrap.php';
class Console extends ConsoleApp
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {
        // 使用CLI工厂类作为默认的服务容器
        $di = new CliDI();

        $di->set('config', function (){
            return require INJECT_PATH . '/config.php';
        }, true);

        /**
         * Registering a router
         */
        $di->set('router', function (){
            return require INJECT_PATH . '/console/router.php';
        }, true);

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', function (){
            return require INJECT_PATH . '/db.php';
        }, true);

        $di->set('parameter',function(){
            return require INJECT_PATH . '/parameter.php';
        }, true);

        /**
         * Handle the request
         */
        $this->setDI($di);
    }

    /**
     * 命令行程序入口
     * @param mixed $argv       命令得参数
     */
    public function main($argv)
    {
        /**
         * Register application modules
         */
        $this->registerServices();


        $modules = require DEPLOY_PATH.'/modules/console.php';

        /**
         * Register application modules
         */
        $this->registerModules($modules);


        /**
         * 处理console应用参数
         */
        $arguments = array();
        foreach ($argv as $k => $arg) {
            if ($k == 1) {
                $arguments['module'] = $arg;
            } elseif ($k == 2) {
                $arguments['task'] = $arg;
            } elseif ($k == 3) {
                $arguments['action'] = $arg;
            }elseif ($k >= 4){
                $arguments['params'][] = $arg;
            }

        }

        // 定义全局的参数， 设定当前任务及动作
        define('CURRENT_MODULE', (isset($argv[1]) ? $argv[1] : null));
        define('CURRENT_TASK',   (isset($argv[2]) ? $argv[2] : null));
        define('CURRENT_ACTION', (isset($argv[3]) ? $argv[3] : null));

        $this->handle($arguments);
    }
}


// 处理参数
$console = new Console();
$console->main($argv);

