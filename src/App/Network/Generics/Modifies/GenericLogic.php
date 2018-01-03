<?php
namespace App\Network\Generics\Modifies;
use App\Globals\Finals\Responder;
use App\Frames\Generics\FrameLogic;
use App\Interfaces\Generics\IRespondable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:09
 *
 * Class GenericLogic
 * @package App\Network\Generics\Creates
 */
abstract class GenericLogic extends FrameLogic implements IRespondable
{
//    public function get()
//    {
//        $toggle = $this->transaction();
//        $responder = Responder::getInstance();
//        $responder->toggle = $toggle;
//        if($toggle)
//            $responder->msg = $this->t('global', 'save_success');
//    }

    public function get()
    {
        $responder = Responder::getInstance();
        $this->commit($responder);
        return $responder;
    }

}