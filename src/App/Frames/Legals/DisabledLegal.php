<?php
namespace App\Frames\Legals;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/22
 * Time: 23:26
 *
 * Class DisabledLogic
 * @package App\Network\Modules\Manager\Distribution\Verifies\Legals
 */
abstract class DisabledLegal extends FrameLegal
{
    protected function initValidation()
    {
        $this->validation->add(['disabled', 'items'], new PresenceOf([
            'message' => [
                'disabled'  => $this->t('toggle', 'presence_disabled'),
                'items'     => $this->t('toggle', 'presence_items')
            ]
        ]));

        $this->validation->add(['disabled'], new Numericality([
            'message'=>[
                'disabled'      => $this->t('toggle', 'numericality_disabled')
            ]
        ]));
    }
}