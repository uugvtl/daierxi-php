<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 19:30
 */

namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;


use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

class MaterialWhere extends BaseWhere
{
    protected function getStmt()
    {
        $this->setNothing(YES);

        $sqlHelper = SqlHelper::getInstance();

        $where = '';

        $ids = $this->getCondition();

        if($ids)
        {
            $quoteIds = $sqlHelper->getSplitQuote($ids);
            $where = " AND wmc.complex_id IN ({$quoteIds})";
        }

        return $where;
    }
}