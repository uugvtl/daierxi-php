<?php
namespace App\Globals\Bases\Sqlangs\Selects;
use App\Globals\Bases\Sqlangs\BaseSelect;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/2
 * Time: 23:50
 *
 * Class NoneSelect
 * @package App\Globals\Sqlangs\Selects
 */
abstract class HideSelect extends BaseSelect
{
    /**
     * 获取最终型态的where条件的where语句
     * @param string $where         SQL语句中的where条件语句
     * @return string               可能是原语句，也可能是永远无法获取数据的where条件语句
     */
    protected function getJudgeWhere($where='')
    {
        empty($where) && $where = " AND FALSE";
        return $where;
    }

}