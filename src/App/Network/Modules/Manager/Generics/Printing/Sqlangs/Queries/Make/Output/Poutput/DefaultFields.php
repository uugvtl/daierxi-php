<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 21:19
 *
 * Class DefaultFields
 * @package App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput
 */
class DefaultFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = [
            'sdetail_id',
            'sku_name',
            'output_num',
            'recipe_weight',
            'deionized_water',
            'is_print',
            'output_status',
            'recipe_craft',
            'water_item'
        ];
    }
}