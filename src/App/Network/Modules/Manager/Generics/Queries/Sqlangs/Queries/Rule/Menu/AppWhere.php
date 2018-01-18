<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Menu;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 19:12
 *
 * Class AppWhere
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Rule\Menu
 */
class AppWhere extends BaseWhere
{
    protected function getStmt()
    {
        $sqlHelper = SqlHelper::getInstance();
        $where = '';

        $condz = $this->getCondition();

        if($sqlHelper->is_numeric($condz, 'team_id'))
        {
            $where .= " AND team_id={$condz['team_id']}";
        }

        return $where;
    }
}