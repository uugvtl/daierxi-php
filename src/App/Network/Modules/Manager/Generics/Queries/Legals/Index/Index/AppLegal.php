<?php
namespace App\Network\Modules\Manager\Generics\Queries\Legals\Index\Index;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 4/1/18
 * Time: 21:12
 *
 * Class DefaultLegal
 * @package App\Network\Modules\Manager\Generics\Queries\Legals\Index\Index
 */
class AppLegal extends BaseLegal
{
    protected function run()
    {
        $this->validation->add(['password', 'account'], new PresenceOf([
            'message' => [
                'password'  =>$this->t('logins', 'presence_password'),
                'account'   =>$this->t('logins', 'presence_account')
            ]
        ]));
    }
}