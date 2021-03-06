<?php
namespace App\Globals\Legals;
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
class EnabledLegal extends BaseLegal
{
    protected function run()
    {
        $this->validation->add(['enabled', 'items'], new PresenceOf([
            'message' => [
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