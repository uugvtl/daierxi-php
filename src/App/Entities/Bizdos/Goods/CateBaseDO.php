<?php
namespace App\Entities\Bizdos\Goods;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 00:13
 *
 * Class CateBaseDo
 * @package App\Entities\Bizdos\Goods
 * @property int    $cate_id            商品分类ID
 * @property int    $parent_id          上级ID
 * @property int    $depth              级别深度
 * @property int    $sort_order         商品分类排序
 * @property int    $disabled           是否禁用
 * @property string $cate_name          商品分类ID
 * @property string $cate_thumb         缩略图
 * @property string $seo_title          标题SEO
 * @property string $seo_keywords       关键字SEO
 * @property string $seo_description    描述SEO
 */
class CateBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'cate_id',
            'parent_id',
            'depth',
            'sort_order',
            'disabled',
            'cate_name',
            'cate_thumb',
            'seo_title',
            'seo_keywords',
            'seo_description',
        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->cate_id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();

        $table = TableConst::GOODS_CATEGORY;

        $fields = $this->getValidFields();

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);
        if($lastId)
        {
            $this->setPersistent(YES);

            $this->setProperty('cate_id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }
        return $this;
    }

    public function submit()
    {
        $table = TableConst::GOODS_CATEGORY;
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->cate_id);
        $where = 'AND cate_id='.$id;

        $sql =  $sqlHelper->getUpdateString($this->getValidFields(), $table, $where);

        $toggle = $this->getCache()->getDao()->submit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}