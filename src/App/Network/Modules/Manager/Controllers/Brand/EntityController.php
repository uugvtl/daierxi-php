<?php
namespace App\Network\Modules\Manager\Controllers\Brand;
use App\Network\Modules\Manager\Common\AppController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 18:19
 *
 * Class EntityController
 * @package App\Network\Modules\Manager\Controllers\Brand
 */
class EntityController extends AppController
{

    public function comboAction()
    {

    }

    public function indexAction()
    {

    }

    public function createAction()
    {
        $posts = $this->getPostParams();
        $container = $this->provider->getCreateContainer($posts);
        $responder = $container->useGeneralize(YES)->get();
        $this->toJsonMsg($responder);
    }
    
    public function modifyAction()
    {
        $posts = $this->getPostParams();
        $container = $this->provider->getCommitContainer($posts);
        $responder = $container->get();
        $this->toJsonMsg($responder);
    }

    public function removeAction()
    {
        $aId = $this->getPrimaryIds();

        $container =  $this->provider->getRemoveContainer($aId);
        $responder = $container->get();
        $this->toJsonMsg($responder);
    }
}