<?php
namespace App\Network\Modules\Manager\Generics\Exports\Factories\Logics;
use App\Globals\Finals\Responder;
use App\Network\Generics\Exports\GenericLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:39
 *
 * Class ExportLogic
 * @package App\Network\Modules\Manager\Generics\Exports\Factories\Logics
 */
class ExportLogic extends GenericLogic
{
    protected function run(Responder $responder)
    {
        $responder->toggle = YES;
        $responder->adapter = $this->getAdapter();
    }
}