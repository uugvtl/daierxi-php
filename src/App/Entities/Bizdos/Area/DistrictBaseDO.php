<?php
namespace App\Entities\Bizdos\Area;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;
use App\Tables\Area\IDistrictTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 14:05
 *
 * Class DistrictBaseEntity
 * @package App\Entities\Bizdos\Area
 * @property int    $id             城镇ID
 * @property string $name           城镇名称
 * @property int    $parent_id      上层ID
 * @property string $short_name     城镇简称
 * @property int    $depth          层级深度
 * @property string $city_code      城镇编号
 * @property string $zip_code       邮政编码
 * @property string  $merger_name   合并名称
 * @property double $lng            纬度
 * @property double $lat            经度
 * @property string $pinyin         拼音
 * @property string $leaf           叶子结点
 */
class DistrictBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'id',
            'name',
            'parent_id',
            'short_name',
            'depth',
            'city_code',
            'zip_code',
            'merger_name',

            'lng',
            'lat',
            'pinyin',
            'leaf'

        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->id;
    }

    public function insert()
    {
        $table = IDistrictTable::Name;

        $fields = $this->getValidFields();

        $sqlHelper = SqlHelper::getInstance();

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $toggle = $this->getCache()->getDao()->submit($sql);
        if($toggle)
        {
            $this->setPersistent(YES);
            $this->setProperty('id', $this->id);
            $this->getCache()->updateCacheDependencies($table);
        }
        return $this;

    }

    public function submit()
    {
        $table = IDistrictTable::Name;
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