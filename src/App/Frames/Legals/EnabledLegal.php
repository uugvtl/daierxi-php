<?php
namespace App\Frames\Legals;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/22
 * Time: 23:21
 *
 * Class EnabledLogic
 * @package App\Network\Modules\Manager\Distribution\Verifies\Legals
 */
abstract class EnabledLegal extends FrameLegal
{
    protected function initValidation()
    {
        $this->validation->add(['enabled', 'items'], new PresenceOf([
            'message' => [
                'enabled'   => $this->t('toggle', 'presence_enabled'),
                'items'     => $this->t('toggle', 'presence_items')
            ]
        ]));

        $this->validation->add(['enabled'], new Numericality([
            'message'=>[
                'enabled'      => $this->t('toggle', 'numericality_enabled')
            ]
        ]));
    }
}