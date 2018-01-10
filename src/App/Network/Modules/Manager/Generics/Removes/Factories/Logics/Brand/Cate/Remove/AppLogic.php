<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Brand\Cate\Remove;
use App\Datasets\Consts\TableConst;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\RemoveLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 01:41
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Brand\Cate\Remove
 */
class AppLogic extends RemoveLogic
{
    private $sqls=[];

    protected function beforeBegin()
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {
            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND brand_type_id IN ({$quoteIds})";
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::BRAND_TYPE, $where);
            $this->sqls[] = $sqlHelper->getUpdateString(['brand_type_id' => 0], TableConst::BRAND, $where);
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
                $cache->updateCacheDependencies([TableConst::BRAND_TYPE, TableConst::BRAND]);

            }
        }

    }


}