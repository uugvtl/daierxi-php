<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Globals\Sqlangs\BaseTable;
use App\Tables\Warehouse\IMaterialComplexTable;
use App\Tables\Warehouse\IMaterialTable;

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
        $wmcTable = IMaterialComplexTable::Name;
        $wmTable = IMaterialTable::Name;

        $this->joinTable = "    {$wmcTable} wmc
                            LEFT JOIN
                                {$wmTable} wm ON wmc.material_id=wm.material_id";

        $this->tableList = [$wmcTable, $wmTable];
    }
}