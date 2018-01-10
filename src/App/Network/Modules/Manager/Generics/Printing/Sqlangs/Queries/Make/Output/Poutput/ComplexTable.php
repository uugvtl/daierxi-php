<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Datasets\Consts\TableConst;
use App\Globals\Sqlangs\BaseTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 21:37
 *
 * Class ComplexTable
 * @package App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput
 */
class ComplexTable extends BaseTable
{
    protected function afterInstance()
    {
        $srcTable = TableConst::STOCK_RECIPE_COMPLEX;
        $wcTable = TableConst::WAREHOUSE_COMPLEX;
        $this->joinTable = "    {$srcTable} src
                            LEFT JOIN
                                {$wcTable} wc ON src.complex_id=wc.complex_id";

        $this->tableList = [$srcTable, $wcTable];
    }
}