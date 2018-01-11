<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Index;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\PresenceOf;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 17:39
 *
 * Class IndexLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Index
 */
class IndexLegal extends BaseLegal
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