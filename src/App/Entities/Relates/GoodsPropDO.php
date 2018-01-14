<?php
namespace App\Entities\Relates;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 13/1/18
 * Time: 21:26
 *
 * Class GoodsPropDO
 * @package App\Entities\Relates
 * @property int    $id             自增ID
 * @property int    $goods_id       商品ID，表vz_goods表的主键
 * @property int    $prop_id        属性ID，表vz_goods_prop表的主键
 * @property int    $prop_depth     属性层级深度，表vz_goods_prop表的主键
 * @property int    $is_leaf        是否是结点，1：是，0：否
 */
class GoodsPropDO extends BaseDO
{
    protected function column()
    {
        return [
            'id',
            'goods_id',
            'prop_id',
            'prop_depth',
            'is_leaf'
        ];
    }

    public function primaryKey()
    {
        return $this->id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();
        $table = TableConst::GOODS_SKU_PROP;

        $sql = $sqlHelper->getCreateString($this->getValidFields(), $table, SqlHelper::SQL_CREATE_IGNORE);
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
        $table = TableConst::GOODS_SKU_PROP;

        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->id);
        $where = 'AND id='.$id;


        $sql =  $sqlHelper->getUpdateString($this->getProperties(), $table, $where);

        $toggle = $this->getCache()->getDao()->commit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}