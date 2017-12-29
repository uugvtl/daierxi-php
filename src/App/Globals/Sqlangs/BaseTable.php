<?php
namespace App\Globals\Sqlangs;
use App\Globals\Bases\BaseClass;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/12/1
 * Time: 18:56
 *
 * Class BaseTable
 * @package App\Globals\Sqlangs\Tables
 */
abstract class BaseTable extends BaseClass
{
    /**
     * 关联表名称 例 user u LEFT JOIN user_extra ue ON u.uesr_id=ue.user_id
     * @var string
     */
    protected $joinTable;

    /**
     * 以半角逗号分隔的表别名
     * @var string
     */
    protected $aliasTable;

    /**
     * 需要在afterInit方法里面初始化，，一个表名称的数组
     * @var string[]
     */
    protected $tableList=[];


    /**
     * 获取表或是关联表名称
     * @return string
     */
    public function getJoinTable()
    {
        return $this->joinTable;
    }

    /**
     * 获取一组数据表名称
     * @return array
     */
    public function getTableList()
    {
        return $this->tableList;
    }


    /**
     * 以半角逗号分隔的表别名
     * @return string
     */
    public function getAliasTable()
    {
        return $this->aliasTable?$this->aliasTable:'';
    }
}