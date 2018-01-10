<?php
namespace App\Entities\Bizdos\Area;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 16:26
 *
 * Class StreetBaseDo
 * @package App\Entities\Bizdos\Area
 * @property int    $street_id      街道ID
 * @property int    $district_id    城镇ID
 * @property string $street_name    街道名称
 */
class StreetBaseDO extends BaseDO
{
    final protected function column()
    {
        return [
            'street_id',
            'district_id',
            'street_name'
        ];
    }

    /**
     * @return int
     */
    final public function primaryKey()
    {
        return $this->street_id;
    }

    public function insert()
    {
        $table = TableConst::STREET;

        $fields = $this->getValidFields();

        $sqlHelper = SqlHelper::getInstance();

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $toggle = $this->getCache()->getDao()->submit($sql);
        if($toggle)
        {
            $this->setPersistent(YES);
            $this->setProperty('street_id', $this->street_id);
            $this->getCache()->updateCacheDependencies($table);
        }
        return $this;
    }

    public function submit()
    {
        $table = TableConst::STREET;
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->street_id);
        $where = 'AND street_id='.$id;

        $sql =  $sqlHelper->getUpdateString($this->getValidFields(), $table, $where);

        $toggle = $this->getCache()->getDao()->submit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}