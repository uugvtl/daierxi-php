<?php
namespace App\Console\Generics\Initializes;
use App\Frames\Generics\FrameLogic;
use App\Globals\Finals\Responder;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:47
 *
 * Class GenericLogic
 * @package App\Console\Generics\Initializes
 */
abstract class GenericLogic extends FrameLogic
{
    public function get()
    {
        $responder = Responder::getInstance();
        $this->run($responder);
        return $responder;
    }

}