<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Entities\Bizdos\Goods\Cate;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDisabledDO;
use App\Helpers\StringHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 22:37
 *
 * Class ToggleDO
 * @package App\Network\Modules\Manager\Generics\Modifies\Entities\Bizdos\Goods\Cate
 */
class ToggleDO extends BaseDisabledDO
{
    public function insert()
    {
        return $this->submit();
    }

    public function submit()
    {
        if($this->items)
        {
            $table = TableConst::GOODS_CATEGORY;
            $stringHelper = StringHelper::getInstance();

            $ids = explode(',', $this->items);
            $sqls = array_reduce($ids, function($result, $id) use ($table, $stringHelper){
                $quote_disabled = $stringHelper->quoteValue($this->disabled);
                $result[] ="UPDATE 
                                {$table} 
                            SET 
                                disabled={$quote_disabled}
                            WHERE 
                                cate_id={$id}\n";
                return $result;
            });

            $toggle = $this->getCache()->getDao()->commit($sqls);
            $this->setPersistent(YES);
            $toggle && $this->getCache()->updateCacheDependencies($table);
        }
        return $this;
    }
}