<?php
namespace App\Network\Modules\Manager\Generics\Printing\Factories\Logics;
use App\Globals\Finals\Responder;
use App\Network\Generics\Printing\GenericLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 18:13
 *
 * Class PrintLogic
 * @package App\Network\Modules\Manager\Generics\Printing\Factories\Logics
 */
class AppLogic extends GenericLogic
{
    protected function commit()
    {
        return false;
    }

    protected function run(Responder $responder)
    {
        $responder->toggle = NO;
        $responder->adapter = $this->getAdapter();

    }


}