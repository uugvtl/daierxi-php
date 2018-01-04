<?php
namespace App\Network\Modules\Manager\Events;
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
 * Date: 4/1/18
 * Time: 22:34
 *
 * Class SigninEvent
 * @package App\Network\Modules\Manager\Events
 */
class SigninEvent extends FrameClass
{

    /**
     * @var ModuleController
     */
    private $ctrl;

    /**
     * 控制器名称
     * @var string
     */
    private $distributerCtrlName;

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
     * 设置控制器名称，
     * @param string $ctrlString
     * @return $this
     */
    final public function setDistributerCtrlName($ctrlString)
    {
        $this->distributerCtrlName = $ctrlString;
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
        $toggle = true;
        $cookiesHelper = CookiesHelper::getInstance();
        $cookieValue = $cookiesHelper->setCookies($this->cookies)->getLoginCookie(LOGIN_MANAGER);
        if($cookieValue)
        {
            $instanceHelper = InstanceHelper::getInstance();
            $provider = $instanceHelper->build(NetworkContainerProvider::class, $providerClassString);
            $distributer = $this->getCtrl()->createDistributer($dispatcher);
            $distributer->setCtrlString($this->getDistributerCtrlName());
            $provider->init($distributer);

            $responder = $provider->setGeneralize(YES)->setPrefixString('Cookie')->getQueryResponder($cookieValue);
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

    /**
     * @return string
     */
    final protected function getDistributerCtrlName()
    {
        return $this->distributerCtrlName;
    }
}