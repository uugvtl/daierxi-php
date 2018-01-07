<?php
namespace App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 21:24
 *
 * Class DefaultWhere
 * @package App\Network\Modules\Manager\Generics\Printing\Sqlangs\Queries\Make\Output\Poutput
 */
class AppWhere extends BaseWhere
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
            $where .= " AND sdetail_id={$quote_value}";
        }

        return $where;
    }
}