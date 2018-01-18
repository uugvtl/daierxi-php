<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Menu;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 22:56
 *
 * Class AppFields
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Menu
 */
class AppFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = array(
            'menu_id id',
            'pid',
            'text',
            'route_name',
            'superiors',
            'depth',
            'pos',
            'leaf'
        );

        $this->orderstmt = "ORDER BY pid ASC, pos ASC, menu_id ASC";
    }
}