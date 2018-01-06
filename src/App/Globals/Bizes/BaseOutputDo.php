<?php
namespace App\Globals\Bizes;
use App\Datasets\Consts\OutputStatusConst;
use App\Interfaces\Entities\IChangeStatusable;
use App\Interfaces\Entities\IOutputable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 13:33
 *
 * Class OutputBaseDo
 * @package App\Globals\Bizes
 * @property int    $output_status      出库状态
 * @property bool   $is_print           是否打印出库单，true 已打印，否则false
 */
abstract class BaseOutputDo extends BaseDo implements IOutputable
{
    /**
     * @var IChangeStatusable
     */
    protected $statusBo;

    /**
     * 构造方法运行后的初始化方法
     */
    protected function afterInstance()
    {
        parent::afterInstance();
        $output_status = $this->output_status ? $this->output_status:OutputStatusConst::STATUS_CONFIRM;
        $this->statusBo = $this->createStatusBo($output_status);
    }

    /**
     * @param IChangeStatusable $statusBo
     * @return static
     */
    public function setStatusBo(IChangeStatusable $statusBo)
    {
        $this->statusBo = $statusBo;
        return $this;
    }

    /**
     * 设置出库单的打印状态为已打印
     * @return static
     */
    public function setPrinted()
    {
        $this->setProperty('is_print', 1);
        return $this;
    }

    /**
     * 此出库单是否已打印
     * @return bool
     */
    public function isPrinted()
    {
        return (bool)$this->is_print;
    }

    /**
     * 此出库单是否为线上的订单
     * @return bool
     */
    public function isOnline()
    {
        return false;
    }

    /**
     * 获取出库状态码
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->output_status;
    }

    /**
     * 设置状态为：已取消
     * @return static
     */
    public function changeCancelStatus()
    {
        $this->statusBo->changeCancelStatus();
        return $this;
    }

    /**
     * 设置状态为：订单关闭
     * @return static
     */
    public function changeCloseStatus()
    {
        $this->statusBo->changeCloseStatus();
        return $this;
    }

    /**
     * 设置状态为：确认(待配货)
     * @return static
     */
    public function changeConfirmStatus()
    {
        $this->statusBo->changeConfirmStatus();
        return $this;
    }

    /**
     * 设置状态为：已发货
     * @return static
     */
    public function changeDeliveryStatus()
    {
        $this->statusBo->changeDeliveryStatus();
        return $this;
    }

    /**
     * 设置状态为：无退货订单完成
     * @return static
     */
    public function changeFinishAllStatus()
    {
        $this->statusBo->changeFinishAllStatus();
        return $this;
    }

    /**
     * 设置状态为：部分退货订单完成
     * @return static
     */
    public function changeFinishPartStatus()
    {
        $this->statusBo->changeFinishPartStatus();
        return $this;
    }

    /**
     * 设置状态为：已服务(美容院项目订单用)
     * @return static
     */
    public function changeHasServiceStatus()
    {
        $this->statusBo->changeHasServiceStatus();
        return $this;
    }

    /**
     * 设置状态为：已付定金(美容院项目订单用)
     * @return static
     */
    public function changePaidDepositStatus()
    {
        $this->statusBo->changePaidDepositStatus();
        return $this;
    }

    /**
     * 设置状态为：已付款
     * @return static
     */
    public function changePaidStatus()
    {
        $this->statusBo->changePaidStatus();
        return $this;
    }

    /**
     * 设置状态为：已配货
     * @return static
     */
    public function changePrepareStatus()
    {
        $this->statusBo->changePrepareStatus();
        return $this;
    }

    /**
     * 设置状态为：已收货
     * @return static
     */
    public function changeReceiptStatus()
    {
        $this->statusBo->changeReceiptStatus();
        return $this;
    }

    /**
     * 设置状态为：已退款
     * @return static
     */
    public function changeRefundedStatus()
    {
        $this->statusBo->changeRefundedStatus();
        return $this;
    }

    /**
     * 设置状态为：退款处理中
     * @return static
     */
    public function changeRefundingStatus()
    {
        $this->statusBo->changeRefundingStatus();
        return $this;
    }

    /**
     * 设置状态为：全部商品已退货完成
     * @return static
     */
    public function changeReturnedAllStatus()
    {
        $this->statusBo->changeReturnedAllStatus();
        return $this;
    }

    /**
     * 设置状态为：部分商品已退货完成
     * @return static
     */
    public function changeReturnedPartStatus()
    {
        $this->statusBo->changeReturnedPartStatus();
        return $this;
    }

    /**
     * 设置状态为：退货处理中
     * @return static
     */
    public function changeReturningStatus()
    {
        $this->statusBo->changeReturningStatus();
        return $this;
    }

    /**
     * 设置状态为：未付款
     * @return static
     */
    public function changeUnpaidStatus()
    {
        $this->statusBo->changeUnpaidStatus();
        return $this;
    }
}