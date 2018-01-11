<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Index\Index;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 22:03
 *
 * Class CookieWhere
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Index\Index
 */
class AppWhere extends BaseWhere
{
    protected function getStmt()
    {
        $this->setNothing(YES);

        $where = '';

        $condz = $this->getCondition();

        $sqlHelper = SqlHelper::getInstance();

        if($sqlHelper->is_numeric($condz, 'manager_id'))
        {
            $where .= " AND m.manager_id={$condz['manager_id']}";
        }


        return $where;
    }
}