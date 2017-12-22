<?php
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
class CFormulaHelper extends CBaseHelper
{
    /**
     * 计算配方单品中材料所在比例
     * @param float $weight     总重量：单位-克
     * @param float $percent    百分比
     * @return float            保留四位小数
     */
    public function calcRecipeWeight($weight, $percent)
    {
        $sth = bcmul($weight, $percent, DECIMAL);
        return bcmul($sth, NARROW100, DECIMAL);
    }
}