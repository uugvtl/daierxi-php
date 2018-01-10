<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Account;
use App\Network\Modules\Manager\Generics\Removes\Factories\Logics\AppLogic;
use App\Datasets\Consts\TableConst;
use App\Globals\Finals\Responder;
use App\Helpers\SqlHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 21:52
 *
 * Class RemoveLogic
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Logics\Account
 */
class RemoveLogic extends AppLogic
{
    private $sql;

    protected function beforeBegin()
    {
        $aIds = $this->getGenericInjecter()->getParameter()->get();

        if($aIds)
        {

            $sqlHelper = SqlHelper::getInstance();
            $quoteIds = $sqlHelper->getSplitQuote($aIds);
            $where = " AND manager_id IN ({$quoteIds})";
            $this->sql = $sqlHelper->getDeleteString(TableConst::MANAGER, $where);

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
                $cache->updateCacheDependencies(TableConst::MANAGER);

            }
        }

    }
}