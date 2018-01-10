<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Account;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 03:14
 *
 * Class AppLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Account\Group
 */
class GroupLegal extends BaseLegal
{
    protected function run()
    {
        $this->validation->add(['grant', 'group_id'], new PresenceOf([
            'message' => [
                'grant'         => $this->t('account', 'presence_manager_id')
            ]
        ]));

        $this->validation->add(['group_id'], new Numericality([
            'message'=>[
                'group_id'      => $this->t('account', 'numericality_manager_group_id')
            ]
        ]));
    }
}