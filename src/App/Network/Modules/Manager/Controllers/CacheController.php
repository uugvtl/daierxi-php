<?php
namespace App\Network\Modules\Manager\Controllers;
use App\Network\Modules\Manager\Common\AppController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 16/1/18
 * Time: 00:04
 *
 * Class CacheController
 * @package App\Network\Modules\Manager\Controllers
 */
class CacheController extends AppController
{
    public function clearAction()
    {
        $container = $this->provider->getRemoveContainer();

        $responder = $container->useGeneralize(YES)->get();
        $this->toJsonMsg($responder);
    }
}