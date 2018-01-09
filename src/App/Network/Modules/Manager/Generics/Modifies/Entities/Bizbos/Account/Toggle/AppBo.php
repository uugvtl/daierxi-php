<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Entities\Bizbos\Account\Toggle;
use App\Globals\Bizes\BaseEnabledDO;
use App\Helpers\StringHelper;
use App\Tables\Manager\IManagerTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 02:49
 *
 * Class AppBo
 * @package App\Network\Modules\Manager\Generics\Modifies\Entities\Bizbos\Account\Toggle
 */
class AppBo extends BaseEnabledDO
{
    public function insert()
    {
        return $this->submit();
    }

    public function submit()
    {
        if($this->items)
        {
            $table = IManagerTable::Name;
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