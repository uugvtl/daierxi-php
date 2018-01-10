<?php
namespace App\Entities\Bizdos\Brand;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 20:59
 *
 * Class EntityBaseDo
 * @package App\Entities\Bizdos\Brand
 * @property int    $brand_id               品牌ID
 * @property string $brand_name             品牌名称
 * @property string $brand_code             品牌标识
 * @property int    $brand_tag              品牌渠道    1-线上旗舰店，2-线下美容院
 * @property int    $brand_rank             品牌排序
 * @property int    $brand_type_id          品牌分类ID
 * @property string $brand_shop_name        总店名称
 * @property string $brand_company_name     品牌公司名称
 * @property string $alias_brand_name       品牌别名
 * @property string $brand_thumb_common     品牌展示缩略图
 * @property string $is_personal            品牌广告图
 * @property string $is_supply              品牌广告图
 * @property string $is_remove              品牌广告图
 */
class EntityBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'brand_id',
            'brand_name',
            'brand_code',
            'brand_tag',
            'brand_rank',
            'brand_type_id',
            'brand_shop_name',
            'brand_company_name',
            'alias_brand_name',
            'brand_thumb_common',
            'is_personal',
            'is_supply',
            'is_remove',
        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->brand_id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();

        $table = TableConst::BRAND;

        $fields = $this->getValidFields();

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);
        if($lastId)
        {
            $this->setPersistent(YES);
            $this->setProperty('brand_id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }
        return $this;
    }

    public function submit()
    {
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $table = TableConst::BRAND;

        $id = $stringHelper->quoteValue($this->brand_id);
        $where = 'AND brand_id='.$id;

        $sql =  $sqlHelper->getUpdateString($this->getValidFields(), $table, $where);

        $toggle = $this->getCache()->getDao()->submit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }


}