<?php
namespace App\Network\Modules\Manager\Controllers;
use App\Globals\Finals\Responder;
use App\Network\Modules\Manager\Common\AppController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/16
 * Time: 22:36
 *
 * Class ErrorsController
 * @package App\Network\Modules\Manager\Controllers
 */
class ErrorsController extends AppController
{
    /**
     * 显示404页面
     */
    public function show404Action()
    {
        $result = Responder::getInstance();
        $result->msg = $this->t('errors', 'invalid_url');
        $this->toJsonMsg($result);
    }
}