<?php
namespace App\Network\Generics\Queries;
use App\Globals\Finals\Responder;
use App\Globals\Generics\BaseLogic;
use App\Interfaces\Generics\IRespondable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericLogic
 * @package App\Network\Generics\Queries
 */
abstract class GenericLogic  extends BaseLogic implements IRespondable
{
    public function get()
    {
        $responder = Responder::getInstance();
        $this->run($responder);
        return $responder;
    }
}