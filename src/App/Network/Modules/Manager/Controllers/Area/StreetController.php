<?php
namespace App\Network\Modules\Manager\Controllers\Area;
use App\Network\Modules\Manager\Common\AppController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 18:56
 *
 * Class StreetController
 * @package App\Network\Modules\Manager\Controllers\Area
 */
class StreetController extends AppController
{
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