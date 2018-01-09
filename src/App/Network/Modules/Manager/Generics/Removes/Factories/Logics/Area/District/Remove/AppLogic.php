<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Area\District\Remove;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\RemoveLogic;
use App\Tables\Area\IDistrictTable;
use App\Tables\Area\IStreetTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 14:32
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Area\District\Remove
 */
class AppLogic extends RemoveLogic
{
    private $sqls = [];

    protected function beforeBegin()
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {
            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND id IN ({$quoteIds})";
            $this->sqls[] = $sqlHelper->getDeleteString(IDistrictTable::Name, $where);
            $this->sqls[] = $sqlHelper->getUpdateString(['district_id' => 0], IStreetTable::Name, " AND district_id IN ({$quoteIds})");
        }
    }

    protected function run(Responder $responder)
    {
        if($this->sqls)
        {
            $store = $this->getStore();
            $cache = $store->getCache();
            $dao = $cache->getDao();
            $toggle = $dao->submit($this->sqls);
            if($toggle)
            {
                $responder->toggle = (boolean)$toggle;
                $cache->updateCacheDependencies(IDistrictTable::Name);

            }
        }

    }
}