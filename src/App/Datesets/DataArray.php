<?php
namespace App\Datasets;
/**
 * 项目相关的数据配置类
 * User: leon
 * Date: 2016/11/15
 * Time: 16:09
 */
abstract class DataArray
{
    /**
     * 表vz_brand当中的brand_tag字段的中文意思
     * @var array
     */
    public static $brand_tag_text = [
        1 => '线上旗舰店',
        2 => '线下美容院',
    ];

    /**
     * 表vz_transport_postage中的postage_type字段的中文意思
     * @var array
     */
    public static $postage_type_text = [
        1 => '平邮',
        2 => '快递',
        3 => 'EMS'
    ];

    /**
     * 表vz_manager_operate当中的position字段的中文意思
     * @var array
     */
    public static $op_position_text = [
        1 => '工具栏按钮',
        2 => '表格栏按钮',
    ];

    /**
     * 表vz_goods当中的goods_channel字段的中文意思 商品渠道
     * @var array
     */
    public static $goods_channel_text = [
        1 => '实体商品',
        2 => '线下服务',
        3 => '虚拟商品'
    ];

    /**
     * 表vz_goods当中的goods_channel字段的中文意思 商品状态
     * @var array
     */
    public static $goods_status_text = [
        1 => '上架',
        2 => '下架',
        3 => '停用'
    ];

    /**
     * 表vz_warehouse当中的sku_nature字段的中文意思 产品性质
     * @var array
     */
    public static $sku_nature_text = [
        1 => '普通产品',
        2 => '网络产品',
        3 => '其他产品'
    ];

    /**
     * 表vz_warehouse当中的sku_type字段的中文意思 产品种类
     * @var array
     */
    public static $sku_type_text = [
        1 => '非定制品',
        2 => '定制品',
        3 => '非定制品兼定制品'
    ];

    /**
     * 出库单用到的状态列表 出库状态
     * @var array
     */
    public static $output_status_text = [
        1  => '已取消',
        10 => '未付款',
        20 => '已付款',
        21 => '退款处理中',
        22 => '已退款',
        30 => '已确认',
        35 => '已配货',
        40 => '已发货',
        50 => '已收货',
        51 => '退货处理中',
        52 => '已退货',
        53 => '部分退货',
        60 => '出库完成',
        62 => '交易关闭'
    ];

    /**
     * 订单状态
     * @var array
     */
    public static $order_status_text = [
        1  => '已取消',
        10 => '未付款',
        15 => '已付定金',
        20 => '已付款',
        21 => '退款处理中',
        22 => '已退款',
        30 => '已确认',
        35 => '已配货',
        40 => '已发货',
        50 => '已收货',
        51 => '退货处理中',
        52 => '已退货',
        53 => '部分退货',
        60 => '无退货订单完成',
        61 => '部分退货订单完成',
        62 => '交易关闭',
        90 => '已服务'
    ];

    /**
     * 配方商品的相位数据--暂时定义未使用
     * @var array
     */
    public static $recipe_item_text = [
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
        'E' => 'E',
        'F' => 'F',
        'G' => 'G',
        'H' => 'H',
        'I' => 'I',
        'J' => 'J',
        'K' => 'K'
    ];
}