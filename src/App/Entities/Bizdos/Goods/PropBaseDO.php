<?php
namespace App\Entities\Bizdos\Goods;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 13/1/18
 * Time: 15:52
 *
 * Class PropBaseDO
 * @package App\Entities\Bizdos\Goods
 * @property int       $prop_id
 * @property array     $brand_ids
 * @property string    $prop_name
 */
class PropBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'prop_id',
            'prop_name'
        ];
    }

    protected function afterInstance()
    {
        parent::afterInstance();
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->prop_id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();
        $table = TableConst::GOODS_PROP;

        $sql = $sqlHelper->getCreateString($this->getValidFields(), $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);

        if($lastId)
        {
            $this->setPersistent(YES);
            $this->setProperty('prop_id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }

        return $this;
    }

    public function submit()
    {

        $table = TableConst::GOODS_PROP;
        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->prop_id);
        $where = 'AND prop_id='.$id;
        $sql =  $sqlHelper->getUpdateString($this->getValidFields(), $table, $where);
        $this->getCache()->getDao()->submit($sql) && $this->getCache()->updateCacheDependencies($table);
        $this->setPersistent(YES);
        return $this;
    }
}