<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Signin;
use App\Datasets\Consts\TableConst;
use App\Globals\Sqlangs\BaseTable;
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

        $mTable = TableConst::MANAGER_PROFILE;
        $mgTable= TableConst::MANAGER_TEAM;

        $this->joinTable = "    {$mTable} m 
                            LEFT JOIN
                                {$mgTable} mg ON m.team_id=mg.team_id";

        $this->tableList = [$mTable, $mgTable];
    }
}