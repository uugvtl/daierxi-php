<?php
namespace App\Interfaces\Entities;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 03:33
 *
 * Interface IChangeStatusable
 * @package App\Interfaces\Entities
 */
interface IChangeStatusable
{
    /**
     * 设置状态为：已取消
     * @return static
     */
    public function changeCancelStatus();

    /**
     * 设置状态为：订单关闭
     * @return static
     */
    public function changeCloseStatus();

    /**
     * 设置状态为：确认(待配货)
     * @return static
     */
    public function changeConfirmStatus();

    /**
     * 设置状态为：已发货
     * @return static
     */
    public function changeDeliveryStatus();

    /**
     * 设置状态为：无退货订单完成
     * @return static
     */
    public function changeFinishAllStatus();

    /**
     * 设置状态为：部分退货订单完成
     * @return static
     */
    public function changeFinishPartStatus();

    /**
     * 设置状态为：已服务(美容院项目订单用)
     * @return static
     */
    public function changeHasServiceStatus();

    /**
     * 设置状态为：已付定金(美容院项目订单用)
     * @return static
     */
    public function changePaidDepositStatus();

    /**
     * 设置状态为：已付款
     * @return static
     */
    public function changePaidStatus();

    /**
     * 设置状态为：已配货
     * @return static
     */
    public function changePrepareStatus();

    /**
     * 设置状态为：已收货
     * @return static
     */
    public function changeReceiptStatus();

    /**
     * 设置状态为：已退款
     * @return static
     */
    public function changeRefundedStatus();

    /**
     * 设置状态为：退款处理中
     * @return static
     */
    public function changeRefundingStatus();

    /**
     * 设置状态为：全部商品已退货完成
     * @return static
     */
    public function changeReturnedAllStatus();

    /**
     * 设置状态为：部分商品已退货完成
     * @return static
     */
    public function changeReturnedPartStatus();

    /**
     * 设置状态为：退货处理中
     * @return static
     */
    public function changeReturningStatus();

    /**
     * 设置状态为：未付款
     * @return static
     */
    public function changeUnpaidStatus();
}