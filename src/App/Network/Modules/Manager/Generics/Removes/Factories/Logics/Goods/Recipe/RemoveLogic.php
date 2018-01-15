<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Goods\Recipe;
use App\Datasets\Consts\TableConst;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 15:06
 *
 * Class RemoveLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Goods\Recipe
 */
class RemoveLogic extends AppLogic
{
    private $sqls=[];

    protected function beforeBegin()
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {
            $fields = [
                'goods_id'=>0
            ];

            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND goods_id IN ({$quoteIds})";
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::GOODS_RECIPE, $where);
            $this->sqls[] = $sqlHelper->getUpdateString($fields,TableConst::GOODS_RECIPE_COMPLEX, $where);
            $this->sqls[] = $sqlHelper->getUpdateString($fields,TableConst::GOODS_RECIPE_MATERIAL, $where);
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
                $tables = [
                    TableConst::GOODS_RECIPE,
                    TableConst::GOODS_RECIPE_COMPLEX,
                    TableConst::GOODS_RECIPE_MATERIAL
                ];

                $responder->toggle = (boolean)$toggle;
                $cache->updateCacheDependencies($tables);

            }
        }

    }
}