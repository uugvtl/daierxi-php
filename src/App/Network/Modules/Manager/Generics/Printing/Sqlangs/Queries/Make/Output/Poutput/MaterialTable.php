<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Datasets\Consts\TableConst;
use App\Globals\Sqlangs\BaseTable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 19:31
 *
 * Class MaterialTable
 * @package App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput
 */
class MaterialTable extends BaseTable
{
    protected function afterInstance()
    {
        $wmcTable = TableConst::WAREHOUSE_MATERIAL_COMPLEX;
        $wmTable = TableConst::WAREHOUSE_MATERIAL;

        $this->joinTable = "    {$wmcTable} wmc
                            LEFT JOIN
                                {$wmTable} wm ON wmc.material_id=wm.material_id";

        $this->tableList = [$wmcTable, $wmTable];
    }
}