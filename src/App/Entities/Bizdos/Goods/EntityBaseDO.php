<?php
namespace App\Entities\Bizdos\Goods;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 16:38
 *
 * Class EntityBaseDO
 * @package App\Entities\Bizdos\Goods
 * @property int    $supplier_id    供应商ID
 * @property int    $goods_id       商品ID
 * @property int    $brand_id       品牌ID
 * @property int    $one_cate_id    商品一级分类ID
 * @property int    $two_cate_id    商品二级分类ID
 * @property int    $three_cate_id  商品三级分类ID
 * @property int    $rule_id        物流规则ID
 * @property int    $default_sku    默认SKU的ID
 * @property int    $return_policy  退货政策
 * @property int    $sort_order     排序
 * @property int    $is_retail      是否零售
 * @property int    $is_supply      是否进货
 * @property int    $is_recipe      是否配方
 * @property int    $prop_nums      属性数量
 * @property int    $goods_channel  商品渠道
 * @property int    $goods_status   商品状态
 * @property int    $goods_addtime  添加时间
 * @property string $goods_name     商品名称
 * @property string $goods_desc     商品描述
 * @property string $goods_image    商品图片
 */
class EntityBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'supplier_id',
            'goods_id',
            'brand_id',
            'one_cate_id',
            'two_cate_id',
            'three_cate_id',
            'rule_id',
            'default_sku',

            'return_policy',
            'sort_order',

            'is_retail',
            'is_supply',
            'is_recipe',

            'prop_nums',

            'goods_channel',
            'goods_status',
            'goods_addtime',
            'goods_name',
            'goods_desc',
            'goods_image'
        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->goods_id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();

        $table     = TableConst::GOODS;

        $this->setProperty('goods_addtime', time());
        $fields = $this->getValidFields();


        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);

        if($lastId)
        {
            $this->setPersistent(YES);

            $this->setProperty('goods_id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }

        return $this;
    }

    public function submit()
    {
        $table = TableConst::GOODS;
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->goods_id);
        $where = ' AND goods_id='.$id;

        $sql =  $sqlHelper->getUpdateString($this->getValidFields(), $table, $where);

        $this->setPersistent(YES);
        $this->getCache()->getDao()->submit($sql) && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}