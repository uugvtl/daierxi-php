<?php
namespace App\Entities\Bizdos\Goods;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 14:22
 *
 * Class RecipeBaseDO
 * @package App\Entities\Bizdos\Goods
 * @property int       $goods_id
 * @property string    $recipe_craft
 * @property string    $water_item
 * @property string    $sku_material_rate
 * @property float     $deionized_water
 * @property float     $sku_recipe_weight
 */
class RecipeBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'goods_id',
            'recipe_craft',
            'water_item',
            'sku_material_rate',
            'deionized_water',
            'sku_recipe_weight'
        ];
    }

    public function primaryKey()
    {
        return $this->goods_id;
    }

    public function insert()
    {
        $gTable = TableConst::GOODS;
        $grTable = TableConst::GOODS_RECIPE;

        $goodsId = $this->primaryKey();

        $sqlhelper = SqlHelper::getInstance();

        $fields = [
            'goods_id'          => $goodsId,
            'deionized_water'   => $this->deionized_water,
            'water_item'        => $this->water_item,
            'sku_material_rate' => serialize($this->sku_material_rate)
        ];
        $fields = array_filter($fields);
        $sql = $sqlhelper->getCreateString($fields, $grTable, SqlHelper::SQL_CREATE_IGNORE);
        $toggle = $this->getCache()->getDao()->submit($sql);

        if($toggle)
        {
            $where = " AND goods_id={$goodsId}";
            $sql = $sqlhelper->getUpdateString(array('is_recipe'=>1), $gTable, $where);
            $this->getCache()->getDao()->submit($sql);
            $this->setPersistent(YES);
            $this->getCache()->updateCacheDependencies([$gTable, $grTable]);
        }

        return $this;
    }

    public function submit()
    {
        $table = TableConst::GOODS_RECIPE;
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->primaryKey());
        $where = 'AND goods_id='.$id;


        $fields = [
            'water_item'        => $this->water_item,
            'deionized_water'   => $this->deionized_water,
            'sku_material_rate' => serialize($this->sku_material_rate)
        ];
        $fields = array_filter($fields);
        $sql =  $sqlHelper->getUpdateString($fields, $table, $where);

        $toggle = $this->getCache()->getDao()->commit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}