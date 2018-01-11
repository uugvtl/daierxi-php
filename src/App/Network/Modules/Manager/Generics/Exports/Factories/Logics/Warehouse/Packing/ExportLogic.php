<?php
namespace App\Network\Modules\Manager\Generics\Exports\Factories\Logics\Warehouse\Packing;
use App\Globals\Finals\Responder;
use App\Network\Modules\Manager\Generics\Exports\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:38
 *
 * Class DefaultLogic
 * @package App\Network\Modules\Manager\Generics\Exports\Factories\Logics\Warehouse\Packing\Export
 */
class ExportLogic extends AppLogic
{
    protected function beforeBegin()
    {
        $this->autoCommit(YES);
    }

    protected function run(Responder $responder)
    {
        $sqlangInjecter = $this->getRepositpry()->get();
        $store = $this->getStore();
        $records = $store->setSqlangInjecter($sqlangInjecter)->setPaging(NO)->getList();

        $columns = [
            '自增ID',
            '货号',
            '包材名称',
            '包材描述',
            '实际库存',
            '退货库存',
            '次品库存',
            '安全库存'
        ];

        if($records)
        {
            $adapter = $this->getAdapter();
            $adapter->setData($records)->setDocname('包材库存统计'.date('Y-m-d'))->setColumns($columns);
            $responder->toggle = YES;
            $responder->adapter = $adapter;
        }

    }
}