<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Account\Remove;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\RemoveLogic;
use App\Tables\Manager\IManagerTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 14:29
 *
 * Class DefaultLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Account\Remove
 */
class DefaultLogic extends RemoveLogic
{
    protected function run(Responder $responder)
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {
            $store = $this->getStore();
            $cache = $store->getCache();
            $dao = $cache->getDao();
            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND manager_id IN ({$quoteIds})";
            $sql = $sqlHelper->getDeleteString(IManagerTable::Name, $where);//  "";
            $toggle = $dao->submit($sql);
            if($toggle)
            {
                $responder->toggle = (boolean)$toggle;
                $cache->updateCacheDependencies(IManagerTable::Name);

            }


        }
    }
}