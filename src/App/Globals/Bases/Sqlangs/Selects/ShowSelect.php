<?php
namespace App\Globals\Bases\Sqlangs\Selects;
use App\Globals\Bases\Sqlangs\BaseSelect;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/2
 * Time: 23:50
 *
 * Class WholeSelect
 * @package App\Globals\Sqlangs\Selects
 */
abstract class ShowSelect extends BaseSelect
{
    protected function getWhere()
    {
        return '';
    }
}