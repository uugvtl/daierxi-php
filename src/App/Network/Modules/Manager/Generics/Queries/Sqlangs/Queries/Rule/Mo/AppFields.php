<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Mo;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 19:51
 *
 * Class AppFields
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Mo
 */
class AppFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = [
            'grant_mo'
        ];
    }
}