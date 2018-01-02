<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Signin;
use App\Globals\Sqlangs\BaseTable;
use App\Tables\Manager\IGroupTable;
use App\Tables\Manager\IManagerTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 23:43
 *
 * Class AccountTable
 * @package App\Network\Modules\Manager\Common\Sqlangs\Signin
 */
class AccountTable extends BaseTable
{
    protected function afterInstance()
    {

        $mTable = IManagerTable::Name;
        $mgTable= IGroupTable::Name;

        $this->joinTable = "    {$mTable} m 
                            LEFT JOIN
                                {$mgTable} mg ON m.group_id=mg.group_id";

        $this->tableList = [$mTable, $mgTable];
    }
}