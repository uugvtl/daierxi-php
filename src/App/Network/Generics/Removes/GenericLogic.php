<?php
namespace App\Network\Generics\Removes;
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
 * @package App\Network\Generics\Removes
 */
abstract class GenericLogic  extends FrameLogic implements IRespondable
{
    public function get()
    {
        $responder = Responder::getInstance();
        $this->commit($responder);
        return $responder;
    }
}