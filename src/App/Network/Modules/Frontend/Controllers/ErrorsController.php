<?php
namespace App\Network\Modules\Frontend\Controllers;
use App\Globals\Finals\Result;
use App\Network\Modules\Frontend\Common\AppController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/16
 * Time: 22:36
 *
 * Class ErrorsController
 * @package App\Network\Modules\Frontend\Controllers
 */
class ErrorsController extends AppController
{
    /**
     * 显示404页面
     */
    public function show404Action()
    {
        $result = Result::getInstance();
        $result->msg = $this->t('errors', 'invalid_url');
        $this->toJsonMsg($result);
    }
}