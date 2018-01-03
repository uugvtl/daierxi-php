<?php
namespace App\Network\Modules\Frontend\Controllers;
use App\Globals\Finals\Responder;
use App\Network\Modules\Frontend\Common\AppController;
class IndexController extends AppController
{
    public function tokenAction()
    {
        $resultBo = Responder::getInstance();
        $resultBo->toggle = YES;
        $resultBo->data = [
            'security_key'  =>$this->security->getTokenKey(),
            'security_value'=>$this->security->getToken()
        ];

        $this->toJsonData($resultBo);
    }

    public function comboAction()
    {
        echo 'combo';
    }

    public function indexAction()
    {
        echo 111;
//        $condz = $this->getSearchParams();
//
//        $responder = $this->provider->getQueryResponder($condz);
//        $this->toJsonData($responder);
    }

    public function storeAction()
    {
    }
}