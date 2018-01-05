<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Warehouse;
use App\Globals\Sqlangs\BaseTable;
use App\Tables\Brand\IBrandTable;
use App\Tables\Warehouse\IPackingTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 17:33
 *
 * Class PackingTable
 * @package App\Network\Modules\Manager\Common\Sqlangs\Warehouse
 */
class PackingTable extends BaseTable
{
    protected function afterInstance()
    {
        $wpTable= IPackingTable::Name;
        $bTable = IBrandTable::Name;

        $this->joinTable = "    {$wpTable} wp
                            LEFT JOIN
                                {$bTable} b ON wp.brand_id=b.brand_id";

        $this->tableList = [$wpTable, $bTable];

    }
}