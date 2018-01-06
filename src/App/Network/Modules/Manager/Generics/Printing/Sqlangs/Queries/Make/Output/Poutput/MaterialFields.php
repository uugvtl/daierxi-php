<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 19:29
 *
 * Class MaterialFields
 * @package App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput
 */
class MaterialFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = [
            'wm.material_sn',
            'wmc.complex_id',
            'wmc.material_id',
            'wmc.material_percent'
        ];
    }
}