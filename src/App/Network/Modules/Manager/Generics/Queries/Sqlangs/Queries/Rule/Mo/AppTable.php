<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Mo;
use App\Datasets\Consts\TableConst;
use App\Globals\Sqlangs\BaseTable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 19:52
 *
 * Class AppTable
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Mo
 */
class AppTable extends BaseTable
{
    protected function afterInstance()
    {
        $table = TableConst::MANAGER_TEAM;
        $this->joinTable = $table;

        $this->tableList[] = $table;
    }
}