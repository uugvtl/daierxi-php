<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Menu;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 18:51
 *
 * Class AppFields
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Menu
 */
class AppFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = [
            'grant_menu'
        ];
    }
}