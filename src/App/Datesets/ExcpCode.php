<?php
namespace App\Datasets;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/9/17
 * Time: 18:00
 *
 * Class ErrorCode
 * @package App\Globals\Datasets
 */
final class ExcpCode
{
    /**
     * 数据提交不成功
     */
    const COMMIT_SQL_EXCEPTION = 90000;

    /**
     * 类中不存在某属性
     */
    const PROPERTY_NOT_IN_CLASS = 90001;

    /**
     * 包材出库时，库存不足
     */
    const OUTPUT_PACKING_NOT_ENOUGH = 90101;

    /**
     * 包材入库记录删除时，库存不足
     */
    const REMOVE_PACKING_INPUT = 90102;

    /**
     * 商品单品出库时，库存不足
     */
    const OUTPUT_SKU_NOT_ENOUGH = 90201;

    /**
     * 商品单品入库记录删除时，库存不足
     */
    const REMOVE_SKU_INPUT = 90202;

    /**
     * 原料品出库时，库存不足
     */
    const OUTPUT_MATERIAL_NOT_ENOUGH = 90301;

    /**
     * 原料入库记录删除时，库存不足
     */
    const REMOVE_MATERIAL_INPUT = 90302;

    /**
     * 生产单品的时候，原料出库库存不足
     */
    const OUTPUT_RECIPE_ENOUGH = 90303;
}