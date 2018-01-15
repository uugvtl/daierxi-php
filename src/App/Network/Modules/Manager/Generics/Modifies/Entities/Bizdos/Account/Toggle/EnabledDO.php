<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Entities\Bizdos\Account\Toggle;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseEnabledDO;
use App\Helpers\StringHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 17:50
 *
 * Class AppDO
 * @package App\Network\Modules\Manager\Generics\Modifies\Entities\Bizdos\Account\Toggle
 */
class EnabledDO extends BaseEnabledDO
{
    public function insert()
    {
        return $this->submit();
    }

    public function submit()
    {
        if($this->items)
        {
            $table = TableConst::MANAGER_PROFILE;
            $stringHelper = StringHelper::getInstance();

            $ids = explode(',', $this->items);
            $sqls = array_reduce($ids, function($result, $id) use ($table, $stringHelper){
                $quote_enabled = $stringHelper->quoteValue($this->enabled);
                $result[] ="UPDATE 
                                {$table} 
                            SET 
                                enabled={$quote_enabled}
                            WHERE 
                                manager_id={$id}\n";
                return $result;
            });

            $toggle = $this->getCache()->getDao()->submit($sqls);
            $this->setPersistent(true);
            $toggle && $this->getCache()->updateCacheDependencies($table);
        }
        return $this;

    }
}