<?php
namespace App\Network\Modules\Manager\Controllers;
use App\Globals\Finals\Responder;
use App\Helpers\CookiesHelper;
use App\Helpers\StringHelper;
use App\Network\Modules\Manager\Common\ComController;
use Phalcon\Mvc\View;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/16
 * Time: 23:09
 *
 * Class IndexController
 * @package App\Network\Modules\Manager\Controllers
 */
class IndexController extends ComController
{

    public function initialize()
    {
        parent::initialize();
        $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
        $this->view->enable();
    }

    /**
     * 登入界面
     */
    public function indexAction()
    {
        $posts = [];

        $pssword =  $account ='';
        $mainUrl = 'main/index';
        $request = $this->request;


        if($request->isPost())
        {
            if(!extension_loaded('xdebug'))
            {
                $responder = Responder::getInstance();

                if(!$this->security->checkToken())
                {
                    $errorMsg = $this->t('global', 'illegal_sign_in');
                    $responder->toggle = NO;
                    goto finished;
                }
            }

            $posts['account']   = $account  = $request->getPost('account', 'trim');
            $posts['password']  = $password = $request->getPost('password', 'trim');

            $container = $this->provider->getCommitContainer($posts);
            $responder = $container->useGeneralize(YES)->get();
            $errorMsg = $responder->msg;


        }
        else
        {
            $cookiesHelper = CookiesHelper::getInstance();
            $cookieValue = $cookiesHelper->setCookies($this->cookies)->getLoginCookie(LOGIN_MANAGER);

            $container = $this->provider->getQueryContainer($cookieValue);
            $responder = $container->useGeneralize(YES)->get();
            $errorMsg = $responder->msg;

        }

        if($responder->toggle)
        {
            $this->response->redirect($mainUrl);
        }


        finished:
        $this->view->setVar('error_msg', $errorMsg);
        $this->view->setVar('account', $account);
        $this->view->setVar('password', $pssword);
        $this->view->setTemplateAfter('after/login');
    }

    /**
     * 用户退出登陆系统
     */
    public function signOutAction()
    {
        //关闭视图功能
        $this->view->disable();

        $session = $this->session;
        $cookies = $this->cookies;

        $stringHelper = StringHelper::getInstance();

        //清除cookie和session
        if ($session->isStarted()) $session->destroy();
        $cookieName = $stringHelper->cryptString(LOGIN_MANAGER);

        if ($cookies->has($cookieName)) {
            $expire = time() - 1;
            $cookies->delete($cookieName);
            $cookies->set($cookieName, '', $expire, '/');
            setcookie('manager_name', '', $expire, '/');
            setcookie('manager_id', '', $expire, '/');
            setcookie('language', '', $expire, '/');
        }

        $this->response->redirect();
    }

}