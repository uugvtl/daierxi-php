<?php
namespace App\Network\Modules\Frontend\Controllers;
use App\Globals\Finals\Result;
use App\Globals\Stores\Selects\CacheStore;
use App\Network\Modules\ModuleController;
class IndexController extends ModuleController
{
    public function tokenAction()
    {
        $resultBo = Result::getInstance();
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
        echo 'ok1';
    }

    public function storeAction()
    {
        $cacheStore = CacheStore::getInstance();
        $dao = $cacheStore->getDao();
        var_dump($dao);
    }
}