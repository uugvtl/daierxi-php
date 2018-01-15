<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Mo;
use App\Datasets\Consts\TableConst;
use App\Globals\Sqlangs\BaseTable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 23:09
 *
 * Class AppTable
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Mo
 */
class AppTable extends BaseTable
{
    protected function afterInstance()
    {
        $moTable    = TableConst::MANAGER_MENU__OPERATE;
        $oTable     = TableConst::MANAGER_OPERATE;
        $this->joinTable = "    {$oTable} o
                            LEFT JOIN
                                {$moTable} mo ON o.op_id=mo.op_id";

        $this->tableList = [$moTable, $oTable];
    }
}