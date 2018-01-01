<?php
namespace App\Network\Generics\Removes;
use App\Globals\Finals\Responder;
use App\Globals\Generics\FormLogic;
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
abstract class GenericLogic  extends FormLogic implements IRespondable
{
    public function run()
    {
        $toggle = $this->transaction();
        $responder = Responder::getInstance();
        $responder->toggle = $toggle;
        if($toggle)
            $responder->msg = $this->t('global', 'delete_success');
    }
}