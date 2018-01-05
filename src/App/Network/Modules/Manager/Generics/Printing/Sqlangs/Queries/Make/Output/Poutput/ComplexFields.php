<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Globals\Sqlangs\BaseFields;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 21:27
 *
 * Class ComplexFields
 * @package App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput
 */
class ComplexFields extends BaseFields
{
    protected function afterInstance()
    {
        $this->fields = [
            'src.sdetail_id',
            'src.complex_id',
            'src.complex_sn',
            'src.percent',
            'src.output_num',
            'wc.complex_craft',
            'wc.complex_item'
        ];
    }
}