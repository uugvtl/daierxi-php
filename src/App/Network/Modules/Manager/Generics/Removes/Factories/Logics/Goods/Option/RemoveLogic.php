<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Goods\Option;
use App\Datasets\Consts\TableConst;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 14/1/18
 * Time: 11:22
 *
 * Class RemoveLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Goods\Option
 */
class RemoveLogic extends AppLogic
{
    private $sqls=[];

    protected function beforeBegin()
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {
            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND option_id IN ({$quoteIds})";
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::GOODS_OPTION, $where);
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
                $cache->updateCacheDependencies(TableConst::GOODS_OPTION);

            }
        }

    }
}