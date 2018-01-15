<?php
namespace App\Network\Legals\Account;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 01:14
 *
 * Class ManagerLegal
 * @package App\Network\Legals\Account
 */
class ManagerBaseLegal extends BaseLegal
{
    protected function run()
    {
        $this->validation->add(['manager_name'], new PresenceOf([
            'message' => [
                'manager_name'  => $this->t('account', 'presence_manager_name')
            ]
        ]));

        $this->validation->add(['team_id'], new Numericality([
            'message'=>[
                'team_id'      => $this->t('account', 'numericality_team_id')
            ]
        ]));
    }
}