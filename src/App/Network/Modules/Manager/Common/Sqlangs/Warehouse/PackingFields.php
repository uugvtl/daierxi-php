<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Warehouse;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 17:30
 *
 * Class PackingFields
 * @package App\Network\Modules\Manager\Common\Sqlangs\Warehouse
 */
class PackingFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = [
            'wp.*',
            'b.brand_name'
        ];
    }
}