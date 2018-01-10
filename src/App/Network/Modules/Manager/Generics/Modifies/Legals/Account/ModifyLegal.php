<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Account;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 20:28
 *
 * Class DefaultLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Account\Modify
 */
class ModifyLegal extends BaseLegal
{
    protected function run()
    {
        $this->validation->add(['manager_name'], new PresenceOf([
            'message' => [
                'manager_name'  => $this->t('account', 'presence_manager_name')
            ]
        ]));

        $this->validation->add(['group_id','manager_id'], new Numericality([
            'message'=>[
                'group_id'      => $this->t('account', 'numericality_group_id'),
                'manager_id'      => $this->t('account', 'numericality_manager_id')
            ]
        ]));
    }
}