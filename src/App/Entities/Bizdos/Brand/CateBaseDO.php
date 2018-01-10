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
 * Class CateBaseDo
 * @package App\Entities\Bizdos\Brand
 * @property int    $brand_type_id          品牌分类ID
 * @property string $brand_type_name        品牌分类名称
 * @property int    $brand_type_sortrank    排序
 */
class CateBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'brand_type_id',
            'brand_type_name',
            'brand_type_sortrank'
        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->brand_type_id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();

        $table = TableConst::BRAND_TYPE;

        $fields = $this->getProperties();

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);
        if($lastId)
        {
            $this->setPersistent(YES);
            $this->setProperty('brand_type_id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }
        return $this;
    }

    public function submit()
    {
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $table = TableConst::BRAND_TYPE;

        $id = $stringHelper->quoteValue($this->brand_type_id);
        $where = 'AND brand_type_id='.$id;

        $sql =  $sqlHelper->getUpdateString($this->getProperties(), $table, $where);

        $toggle = $this->getCache()->getDao()->submit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}