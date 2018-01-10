<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Entities\Bizbos\Brand\Entity\Toggle;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDisabledDO;
use App\Helpers\StringHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 18:22
 *
 * Class AppBo
 * @package App\Network\Modules\Manager\Generics\Modifies\Entities\Bizbos\Brand\Entity\Toggle
 */
class AppBo extends BaseDisabledDO
{
    public function insert()
    {
        return $this->submit();
    }

    public function submit()
    {
        if($this->items)
        {
            $table = TableConst::BRAND;
            $stringHelper = StringHelper::getInstance();

            $ids = explode(',', $this->items);
            $sqls = array_reduce($ids, function($result, $id) use ($table, $stringHelper){
                $quote_disabled = $stringHelper->quoteValue($this->disabled);
                $result[] ="UPDATE 
                                {$table} 
                            SET 
                                is_remove={$quote_disabled}
                            WHERE 
                                brand_id={$id}\n";
                return $result;
            });

            $toggle = $this->getCache()->getDao()->submit($sqls);
            $this->setPersistent(YES);
            $toggle && $this->getCache()->updateCacheDependencies($table);
        }
        return $this;
    }
}