<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Rule;
use App\Globals\Finals\Responder;
use App\Network\Modules\Manager\Generics\Queries\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 21:33
 *
 * Class MenuLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Rule
 */
class MenuLogic extends AppLogic
{
    protected function run(Responder $responder)
    {
        $responder->toggle = NO;
        $responder->total = 0;
        $responder->data = [];
    }



}