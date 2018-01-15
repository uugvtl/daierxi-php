<?php
namespace App\Network\Modules\Manager\Controllers;
use App\Helpers\ArrayHelper;
use App\Helpers\JsonHelper;
use App\Network\Modules\Manager\Common\AppController;
use Phalcon\Mvc\View;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 21:39
 *
 * Class MainController
 * @package App\Network\Modules\Manager\Controllers
 */
class MainController extends AppController
{
    public function indexAction()
    {
        $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
        $this->view->enable();
        $this->view->setTemplateAfter('after/main');
    }

    /**
     * 获取超级管理员的菜单列表
     */
    public function menuAction()
    {
        $arrayHelper = ArrayHelper::getInstance();
        $jsonHelper = JsonHelper::getInstance();

        $condz = $this->getSearchParams();

        $container = $this->provider->getQueryContainer($condz);
        $responder = $container->get();

        $treeList = $arrayHelper->list2tree($responder->data, 'id');
        $this->response->setContent($jsonHelper->encode($treeList));
        $this->response->send();

    }

    /**
     * 获取超级管理员的操作项列表
     */
    public function moAction()
    {

        $condz = $this->getSearchParams();

        $container = $this->provider->getQueryContainer($condz);
        $responder = $container->get();
        $this->toJsonData($responder);


    }
}