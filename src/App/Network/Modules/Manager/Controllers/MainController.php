<?php
namespace App\Network\Modules\Manager\Controllers;
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
}