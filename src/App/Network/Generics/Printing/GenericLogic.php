<?php
namespace App\Network\Generics\Printing;
use App\Globals\Generics\FormLogic;
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
abstract class GenericLogic  extends FormLogic implements IPrintable
{
    public function run()
    {
        $this->transaction();
//        $toggle = $this->transaction();
//        $responder = Responder::getInstance();
//        $responder->toggle = $toggle;
//        if($toggle)
//            $responder->msg = $this->t('global', 'save_success');
    }

}