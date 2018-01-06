<?php
namespace App\Datasets\Consts;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/5/5
 * Time: 16:25
 *
 * Interface IOutputStatusConst
 * @package App\Globals\Objects\Consts
 */
final class OutputStatusConst
{
    /**
     * @const int 已取消
     */
    const STATUS_CANCEL               = 1;

    /**
     * 未付款
     * @const int 未付款
     */
    const STATUS_UNPAID               = 10;

    /**
     * @const int 已付定金
     */
    const STATUS_PAID_DEPOSIT         = 15;

    /**
     * @const int 已付款
     */
    const STATUS_PAID                 = 20;

    /**
     * @const int 退款处理中
     */
    const STATUS_REFUNDING            = 21;

    /**
     * @const int 已退款
     */
    const STATUS_REFUNDED             = 22;

    /**
     * @const int 已确认(即待配货)
     */
    const STATUS_CONFIRM              = 30;

    /**
     * @const int 已配货
     */
    const STATUS_PREPARE              = 35;

    /**
     * @const int 已发货
     */
    const STATUS_DELIVERY             = 40;

    /**
     * @const int 已收货
     */
    const STATUS_RECEIPT              = 50;

    /**
     * @const int 退货处理中
     */
    const STATUS_RETURNING            = 51;

    /**
     * @const int 已退货完成--全部
     */
    const STATUS_RETURNED_ALL         = 52;

    /**
     * @const int 已退货完成--部分
     */
    const STATUS_RETURNED_PART        = 53;

    /**
     * @const int 无退货订单完成
     */
    const STATUS_FINISH_ALL           = 60;

    /**
     * @const int 部分退货订单完成
     */
    const STATUS_FINISH_PART          = 61;

    /**
     * @const int 交易关闭
     */
    const STATUS_CLOSE                = 62;

    /**
     * @const int 已服务(美容院项目订单用)
     */
    const STATUS_HAS_SERVICE          = 90;
}