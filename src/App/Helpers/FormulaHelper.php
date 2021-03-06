<?php
namespace App\Helpers;
use App\Datasets\Consts\DataConst;
use App\Globals\Bases\BaseSingle;

/**
 * 项目用到的相关数学算法
 * Created by PhpStorm.
 * User: leon
 * Date: 28/11/17
 * Time: 17:47
 *
 * Class CMathHelper
 * @package helpers
 */
class FormulaHelper extends BaseSingle
{
    /**
     * 计算配方单品中材料所在比例
     * @param float $weight     总重量：单位-克
     * @param float $percent    百分比
     * @return float            保留四位小数
     */
    public function calcRecipeWeight($weight, $percent)
    {
        $sth = bcmul($weight, $percent, DataConst::DECIMAL);
        return bcmul($sth, DataConst::SCALE_DOWN_100, DataConst::DECIMAL);
    }
}