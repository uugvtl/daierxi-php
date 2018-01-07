<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Globals\Sqlangs\BaseTable;
use App\Tables\Stock\IRecipeSkuTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 21:21
 *
 * Class DefaultTable
 * @package App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput
 */
class AppTable extends BaseTable
{
    protected function afterInstance()
    {
        $table = IRecipeSkuTable::Name;
        $this->joinTable = $table;

        $this->tableList[] = $table;
    }
}