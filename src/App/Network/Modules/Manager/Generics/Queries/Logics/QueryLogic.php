<?php
namespace App\Network\Modules\Manager\Generics\Queries\Logics;
use App\Globals\Finals\Responder;
use App\Network\Generics\Queries\GenericLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 01:51
 *
 * Class QueryLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Logics
 */
class QueryLogic extends GenericLogic
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
        $store = $this->getRepositpry()->get();
        return $store->getList();
    }

    private function getCount()
    {
        $store = $this->getRepositpry()->get();
        $total = $store->getSqlangInjecter()->getPageInstance()->getTotal();

        return $total?$total:$store->getCount();
    }
}