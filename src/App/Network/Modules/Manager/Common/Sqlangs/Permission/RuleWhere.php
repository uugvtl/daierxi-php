<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Permission;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 21:26
 *
 * Class RuleWhere
 * @package App\Network\Modules\Manager\Common\Sqlangs\Rule
 */
class RuleWhere extends BaseWhere
{
    protected function getStmt()
    {
        $this->setNothing(YES);

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