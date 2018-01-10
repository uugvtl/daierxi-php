<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Area\Street\Remove;
use App\Datasets\Consts\TableConst;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\RemoveLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 18:45
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Area\Street\Remove
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
            $where = " AND street_id IN ({$quoteIds})";
            $this->sql = $sqlHelper->getDeleteString(TableConst::STREET, $where);

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
                $cache->updateCacheDependencies(TableConst::STREET);

            }
        }

    }
}