<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Brand\Cate\Remove;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\RemoveLogic;
use App\Tables\Brand\ITypeTable;

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
    private $sql;

    protected function beforeBegin()
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {

            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND brand_type_id IN ({$quoteIds})";
            $this->sql = $sqlHelper->getDeleteString(ITypeTable::Name, $where);

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
                $cache->updateCacheDependencies(ITypeTable::Name);

            }
        }

    }
}