<?php
namespace App\Network\Modules\Manager\Generics\Exports\Factories\Logics;
use App\Globals\Finals\Responder;
use App\Network\Generics\Exports\GenericLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:39
 *
 * Class ExportLogic
 * @package App\Network\Modules\Manager\Generics\Exports\Factories\Logics
 */
class ExportLogic extends GenericLogic
{
    protected function run(Responder $responder)
    {
        $store = $this->getRepositpry()->get();

        $records = $store->getList();

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