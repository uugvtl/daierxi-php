<?php
namespace App\Console\Generics\Initializes;
use App\Globals\Finals\Responder;
use App\Globals\Generics\FormLogic;
use App\Interfaces\Generics\IRespondable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:47
 *
 * Class GenericLogic
 * @package App\Console\Generics\Initializes
 */
abstract class GenericLogic extends FormLogic implements IRespondable
{
    public function get()
    {
        $toggle = $this->transaction();
        $responder = Responder::getInstance();
        $responder->toggle = $toggle;
        if($toggle)
            $responder->msg = $this->t('global', 'save_success');
    }

}