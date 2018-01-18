<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Mo;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 23:04
 *
 * Class AppFields
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Mo
 */
class AppFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = array(
            'o.op_id',
            'o.symbol',
            'o.glyph',
            'o.disabled',
            'mo.mo_name text'
        );

        $this->orderstmt = " ORDER BY mo.mo_id ASC";
    }
}