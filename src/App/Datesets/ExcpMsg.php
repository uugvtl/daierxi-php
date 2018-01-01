<?php
namespace App\Datasets;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/9/17
 * Time: 19:03
 *
 * Class ExcpMsg
 * @package App\Globals\Datasets
 */
abstract class ExcpMsg
{
    const COMMIT_SQL_EXCEPTION = '数据保存异常，请连联管理员';

    /**
     * 类中不包含某属性
     */
    const PROPERTY_NOT_IN_CLASS = '类 "%s" 中不包含属性 "%s"';

    /**
     * 出库时，库存不足
     */
    const OUTPUT_NOT_ENOUGH = '%s(%s)的库存不足';

    /**
     * 商品单入库记录删除时，库存不足
     */
    const REMOVE_SKU_INPUT = '库存不足，目前不能进行商品单品的入库记录进行删除';

    /**
     * 包材入库记录删除时，库存不足
     */
    const REMOVE_PACKING_INPUT = '库存不足，目前不能进行包材的入库记录进行删除';

    /**
     * 原料入库记录删除时，库存不足
     */
    const REMOVE_MATERIAL_INPUT = '库存不足，目前不能进行原料的入库记录进行删除';


    const OUTPUT_RECIPE_ENOUGH = '生产%s时，原料:%s(%s)的库存不足,需要%s克，现有%s克，还差%s克';
}