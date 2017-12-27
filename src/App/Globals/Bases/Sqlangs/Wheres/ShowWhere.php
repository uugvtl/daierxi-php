<?php
namespace App\Globals\Bases\Generics\Sqlangs\Wheres;
use App\Globals\Bases\Sqlangs\BaseWhere;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/2
 * Time: 23:50
 *
 * Class WholeSelect
 * @package App\Globals\Sqlangs\Selects
 */
abstract class ShowWhere extends BaseWhere
{
    protected function getWhere()
    {
        return '';
    }
}