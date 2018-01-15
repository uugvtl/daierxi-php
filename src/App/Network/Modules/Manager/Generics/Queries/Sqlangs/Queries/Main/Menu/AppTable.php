<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Menu;
use App\Datasets\Consts\TableConst;
use App\Globals\Sqlangs\BaseTable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 22:58
 *
 * Class AppTable
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Menu
 */
class AppTable extends BaseTable
{
    protected function afterInstance()
    {
        $table = TableConst::MANAGER_MENU;

        $this->joinTable = $table;

        $this->tableList = [$table];
    }
}