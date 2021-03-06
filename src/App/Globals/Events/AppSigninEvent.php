<?php
namespace App\Globals\Events;
use App\Datasets\Consts\ClassPrefix;
use App\Frames\FrameClass;
use App\Helpers\CookiesHelper;
use App\Helpers\ErrorsHelper;
use App\Helpers\InstanceHelper;
use App\Network\Modules\ModuleController;
use App\Network\Providers\NetworkContainerProvider;
use Phalcon\Mvc\Dispatcher;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 01:15
 *
 * Class AppSigninEvent
 * @package App\Globals\Events
 */
class AppSigninEvent extends FrameClass
{
    /**
     * @var ModuleController
     */
    private $ctrl;


    final public function init(...$args)
    {

        $ctrl = $args[0];

        if(!$ctrl instanceof ModuleController)
        {
            $errorsHelper = ErrorsHelper::getInstance();
            $errorsHelper->triggerError('init method only accepts Class ModuleController. Input was: '.$ctrl);
        }

        $this->ctrl = $ctrl;

        return $this;
    }


    /**
     * 没有登入状态时，访问登入后的地址，
     * @param Dispatcher $dispatcher        调度器实例
     * @param string $providerClassString   Provider所在的模块类命名
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher, $providerClassString)
    {
        $toggle = false;
        $cookiesHelper = CookiesHelper::getInstance();
        $cookieValue = $cookiesHelper->setCookies($this->cookies)->getLoginCookie(LOGIN_MANAGER);
        if($cookieValue)
        {
            $instanceHelper = InstanceHelper::getInstance();
            $provider = $instanceHelper->build(NetworkContainerProvider::class, $providerClassString);
            $distributer = $this->getCtrl()->madeDistributer($dispatcher);
            $distributer->setCtrlString(ClassPrefix::INDEX)->setActString(ClassPrefix::INDEX);
            $container = $provider->init($distributer)->getQueryContainer($cookieValue);

            $responder = $container->useGeneralize(YES)->get();
            $toggle = $responder->toggle;
        }

        finish:
        return $toggle;
    }

    /**
     * @return ModuleController
     */
    final protected function getCtrl()
    {
        return $this->ctrl;
    }

}