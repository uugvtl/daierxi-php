<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Area\District\Remove;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\RemoveLogic;
use App\Tables\Area\IDistrictTable;

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
    private $sql;

    protected function beforeBegin()
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {

            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND id IN ({$quoteIds})";
            $this->sql = $sqlHelper->getDeleteString(IDistrictTable::Name, $where);

        }
    }

    protected function run(Responder $responder)
    {
        if($this->sql)
        {
            $store = $this->getStore();
            $cache = $store->getCache();
            $dao = $cache->getDao();
            $toggle = $dao->submit($this->sql);
            if($toggle)
            {
                $responder->toggle = (boolean)$toggle;
                $cache->updateCacheDependencies(IDistrictTable::Name);

            }
        }

    }
}