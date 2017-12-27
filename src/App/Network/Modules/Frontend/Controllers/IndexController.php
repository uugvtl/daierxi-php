<?php
namespace App\Network\Modules\Frontend\Controllers;
use App\Globals\Finals\Responder;
use App\Network\Modules\ModuleController;
class IndexController extends ModuleController
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
    }

    public function storeAction()
    {
    }
}