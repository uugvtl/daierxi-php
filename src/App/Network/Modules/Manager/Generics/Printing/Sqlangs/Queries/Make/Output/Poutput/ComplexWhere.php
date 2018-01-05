<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 21:39
 */

namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;


use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

class ComplexWhere extends BaseWhere
{
    protected function getStmt()
    {
        $this->setNothing(YES);

        $where = "";

        $condz = $this->getCondition();

        $sqlHelper = SqlHelper::getInstance();

        if($sqlHelper->is_numeric($condz, 'sdetail_id'))
        {
            $quote_value = $this->getQuoteValue($condz['sdetail_id']);
            $where .= " AND src.sdetail_id={$quote_value}";
        }

        return $where;
    }
}