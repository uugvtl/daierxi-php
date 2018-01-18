<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Permission;
use App\Datasets\Consts\TableConst;
use App\Globals\Sqlangs\BaseTable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 21:26
 *
 * Class RuleTable
 * @package App\Network\Modules\Manager\Common\Sqlangs\Rule
 */
class RuleTable extends BaseTable
{
    protected function afterInstance()
    {
        $table = TableConst::MANAGER_TEAM;
        $this->joinTable = $table;

        $this->tableList[] = $table;
    }
}