<?php
namespace App\Network\Generics\Queries;
use App\Globals\Finals\Responder;
use App\Frames\Generics\FrameLogic;
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
abstract class GenericLogic  extends FrameLogic implements IRespondable
{
    final public function get()
    {
        $responder = Responder::getInstance();
        $this->run($responder);
        return $responder;
    }
}