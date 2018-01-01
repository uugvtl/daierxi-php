<?php
namespace App\Network\Generics\Modifies;
use App\Globals\Finals\Responder;
use App\Globals\Generics\FormLogic;
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
abstract class GenericLogic extends FormLogic implements IRespondable
{
    public function run()
    {
        $toggle = $this->transaction();
        $responder = Responder::getInstance();
        $responder->toggle = $toggle;
        if($toggle)
            $responder->msg = $this->t('global', 'save_success');
    }

}