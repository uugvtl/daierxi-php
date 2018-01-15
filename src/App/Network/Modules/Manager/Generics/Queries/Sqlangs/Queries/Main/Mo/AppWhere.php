<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Mo;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 23:13
 *
 * Class AppWhere
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Main\Mo
 */
class AppWhere extends BaseWhere
{
    protected function getStmt()
    {
        $sqlHelper = SqlHelper::getInstance();

        $where = "";

        $condz = $this->getCondition();

        if($sqlHelper->is_numeric($condz, 'menu_id'))
        {
            $where .= " AND mo.menu_id={$condz['menu_id']}";
        }

        return $where;
    }
}