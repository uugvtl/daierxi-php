<?php
namespace App\Network\Generics\Printing;
use App\Globals\Finals\Responder;
use App\Frames\Generics\FrameLogic;
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
abstract class GenericLogic  extends FrameLogic implements IPrintable
{
    public function get()
    {
        $responder = Responder::getInstance();
        $this->commit($responder);
        return $responder;
    }

}