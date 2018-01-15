<?php
namespace App\Entities\Bizdos\Goods\Recipe;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 14:30
 *
 * Class MaterialBaseDO
 * @package App\Entities\Bizdos\Goods\Recipe
 * @property int       $id
 * @property int       $goods_id
 * @property int       $material_id
 * @property float     $material_percent
 */
class MaterialBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'id',
            'goods_id',
            'material_id',
            'material_percent'
        ];
    }

    public function primaryKey()
    {
        return $this->id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();

        $table = TableConst::GOODS_RECIPE_MATERIAL;

        $fields = $this->getValidFields();

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);

        if($lastId)
        {
            $this->setPersistent(YES);
            $this->setProperty('id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }

        return $this;
    }

    public function submit()
    {
        $table = TableConst::GOODS_RECIPE_MATERIAL;
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->id);
        $where = 'AND id='.$id;

        $sql =  $sqlHelper->getUpdateString($this->getValidFields(), $table, $where);

        $toggle = $this->getCache()->getDao()->submit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}