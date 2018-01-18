<?php
namespace App\Network\Modules\Manager\Controllers;
use App\Helpers\ArrayHelper;
use App\Helpers\JsonHelper;
use App\Network\Modules\Manager\Common\AppController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 18:33
 *
 * Class RuleController
 * @package App\Network\Modules\Manager\Controllers
 */
class RuleController extends AppController
{
    /**
     * 获取管理员授权菜单列表
     */
    public function menuAction()
    {
        $condz = [
            'team_id' => $this->account->team_id
        ];

        if(SUPER_MANAGER!=$this->account->account_id)
        {
            $arrayHelper = ArrayHelper::getInstance();
            $jsonHelper = JsonHelper::getInstance();

            $container = $this->provider->getQueryContainer($condz);
            $responder = $container->get();

            $treeList = $arrayHelper->list2tree($responder->data, 'id');
            $this->response->setContent($jsonHelper->encode($treeList));
            $this->response->send();
        }
        else
        {
            $this->forward('main', $this->dispatcher->getActionName(), $condz);
        }
    }

    /**
     * 获取管理员授权操作列表
     * @param int $menuID
     */
    public function moAction($menuID=1)
    {
        $menuID = (int)$menuID;

        $condz = [
            'menu_id'   =>$menuID,
            'team_id'  => $this->account->team_id
        ];

        if(SUPER_MANAGER!=$this->account->account_id)
        {

            $container = $this->provider->getQueryContainer($condz);
            $responder = $container->get();
            $this->toJsonData($responder);
        }
        else
        {
            $this->forward('main', $this->dispatcher->getActionName(), $condz);
        }

    }
}