<?php
namespace App\Network\Generics\Printing;
use App\Globals\Finals\Responder;
use App\Globals\Generics\BaseLogic;
use App\Interfaces\Generics\IPrintable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericLogic
 * @package App\Network\Generics\Queries
 */
abstract class GenericLogic  extends BaseLogic implements IPrintable
{
    public function get()
    {
        $responder = Responder::getInstance();
        $this->commit($responder);
        return $responder;
    }

}