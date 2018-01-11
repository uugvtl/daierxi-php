<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Logics;
use App\Globals\Finals\Responder;
use App\Network\Generics\Queries\GenericLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 01:51
 *
 * Class QueryLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Logics
 */
class AppLogic extends GenericLogic
{

    protected function run(Responder $responder)
    {
        $total = $this->getCount();
        if($total)
        {
            $responder->toggle = YES;
            $responder->total = $total;
            $responder->data = $this->getList();
        }
    }

    private function getList()
    {
        $sqlangInjecter = $this->getRepositpry()->get();
        $store = $this->getStore();
        $store->setSqlangInjecter($sqlangInjecter);
        return $store->getList();
    }

    private function getCount()
    {
        $total = 0;

        $sqlangInjecter = $this->getRepositpry()->get();
        $store = $this->getStore();
        $store->setSqlangInjecter($sqlangInjecter);

        $pageInstance = $store->getSqlangInjecter()->getPageInstance();
        if($pageInstance)
        {
            $total = $pageInstance->getTotal();
        }

        return $total?$total:$store->getCount();
    }
}