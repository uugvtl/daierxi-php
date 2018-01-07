<?php
namespace App\Network\Modules\Manager\Generics\Creates\Legals\Account\Create;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 01:44
 *
 * Class DefaultLegal
 * @package App\Network\Modules\Manager\Generics\Creates\Legals\Account\Create
 */
class AppLegal extends BaseLegal
{
    protected function run()
    {
        $this->validation->add(['manager_name'], new PresenceOf([
            'message' => [
                'manager_name'  => $this->t('account', 'presence_manager_name')
            ]
        ]));

        $this->validation->add(['group_id'], new Numericality([
            'message'=>[
                'group_id'      => $this->t('account', 'numericality_group_id')
            ]
        ]));
    }
}