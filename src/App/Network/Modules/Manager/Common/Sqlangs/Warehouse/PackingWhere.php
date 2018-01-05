<?php
namespace App\Network\Modules\Manager\Common\Sqlangs\Warehouse;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 17:33
 *
 * Class PackingWhere
 * @package App\Network\Modules\Manager\Common\Sqlangs\Warehouse
 */
class PackingWhere extends BaseWhere
{
    protected function getStmt()
    {
        $where = "";

        $condz = $this->getCondition();
        $sqlHelper = SqlHelper::getInstance();

        if($sqlHelper->is_comma_ids($condz, 'packing_id'))
        {
            $aValues = explode(',', $condz['packing_id']);
            $sQuoteValues = $sqlHelper->getSplitQuote($aValues);
            $where .= " AND wp.packing_id IN ({$sQuoteValues})";
        }

        if($sqlHelper->is_comma_ids($condz, 'brand_id'))
        {
            $aValues = explode(',', $condz['brand_id']);
            $sQuoteValues = $sqlHelper->getSplitQuote($aValues);
            $where .= " AND wp.brand_id IN ({$sQuoteValues})";
        }

        if($sqlHelper->is_string($condz, 'packing_sn'))
        {
            $quoteValue = $this->getQuoteValue($condz['packing_sn'], true);
            $where .= " AND wp.packing_sn LIKE {$quoteValue}";
        }

        if($sqlHelper->is_string($condz, 'packing_name'))
        {
            $quoteValue = $this->getQuoteValue($condz['packing_name'], true);
            $where .= " AND wp.packing_name LIKE {$quoteValue}";
        }

        return $where;
    }
}