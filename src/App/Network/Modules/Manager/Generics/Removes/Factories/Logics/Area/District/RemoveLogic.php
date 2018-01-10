<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Area\District;
use App\Datasets\Consts\TableConst;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 14:32
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Area\District\Remove
 */
class RemoveLogic extends AppLogic
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
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::DISTRICT, $where);
            $this->sqls[] = $sqlHelper->getUpdateString(['district_id' => 0], TableConst::STREET, " AND district_id IN ({$quoteIds})");
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
                $cache->updateCacheDependencies([TableConst::DISTRICT, TableConst::STREET]);

            }
        }

    }
}