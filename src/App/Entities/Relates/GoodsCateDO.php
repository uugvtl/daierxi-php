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
 * Time: 21:28
 *
 * Class GoodsCateDO
 * @package App\Entities\Relates
 * @property int    $id         自增ID
 * @property int    $goods_id   商品ID
 * @property int    $cate_id    分类ID
 */
class GoodsCateDO extends BaseDO
{
    protected function column()
    {
        return [
            'id',
            'goods_id',
            'cate_id'
        ];
    }

    public function primaryKey()
    {
        return $this->id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();
        $table = TableConst::GOODS__CATE;

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
        $table = TableConst::GOODS__CATE;

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