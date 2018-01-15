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
        $this->validation->add(['grant', 'team_id'], new PresenceOf([
            'message' => [
                'grant'         => $this->t('account', 'presence_manager_id')
            ]
        ]));

        $this->validation->add(['team_id'], new Numericality([
            'message'=>[
                'team_id'      => $this->t('account', 'numericality_manager_team_id')
            ]
        ]));
    }
}