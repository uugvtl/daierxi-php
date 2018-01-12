<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Goods\Entity;
use App\Datasets\Consts\TableConst;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 17:07
 *
 * Class RemoveLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Goods\Entity
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
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::GOODS, $where);
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::GOODS__CATE, $where);
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::GOODS_IMAGE, $where);
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::GOODS_QRCODE, $where);
            $this->sqls[] = $sqlHelper->getDeleteString(TableConst::GOODS_RECIPE, $where);
            $this->sqls[] = $sqlHelper->getUpdateString($fields,TableConst::GOODS_RECIPE_COMPLEX, $where);
            $this->sqls[] = $sqlHelper->getUpdateString($fields,TableConst::GOODS_RECIPE_MATERIAL, $where);
            $this->sqls[] = $sqlHelper->getUpdateString($fields,TableConst::GOODS_SKU, $where);
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
                    TableConst::GOODS,
                    TableConst::GOODS__CATE,
                    TableConst::GOODS_IMAGE,
                    TableConst::GOODS_QRCODE,
                    TableConst::GOODS_RECIPE,
                    TableConst::GOODS_RECIPE_COMPLEX,
                    TableConst::GOODS_RECIPE_MATERIAL,
                    TableConst::GOODS_SKU,
                ];

                $responder->toggle = (boolean)$toggle;
                $cache->updateCacheDependencies($tables);

            }
        }

    }
}