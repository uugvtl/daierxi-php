<?php
namespace App\Entities\Bizdos\Goods;
use App\Datasets\Consts\TableConst;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 19:47
 *
 * Class OptionBaseDO
 * @package App\Entities\Bizdos\Goods
 * @property int       $option_id
 * @property int       $prop_id
 * @property string    $text
 */
class OptionBaseDO extends BaseDO
{
    protected function column()
    {
        return [
            'option_id',
            'prop_id',
            'text'
        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->option_id;
    }

    public function insert()
    {
        $table = TableConst::GOODS_OPTION;
        $sqlHelper = SqlHelper::getInstance();

        $fields = $this->getValidFields();
        $fields['hashtext'] = md5($this->text);

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);

        if($lastId)
        {
            $this->setPersistent(YES);

            $this->setProperty('option_id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }

        return $this;
    }

    public function submit()
    {
        return $this;
    }
}