<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Signin;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 23:40
 *
 * Class AccountFields
 * @package App\Network\Modules\Manager\Common\Sqlangs
 */
class AccountFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = [
            'm.manager_id account_id',
            'm.manager_name account_name',
            'm.team_id',
            'mg.team_name',
            'm.enabled'
        ];
    }
}