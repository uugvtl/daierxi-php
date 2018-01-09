<?php
namespace App\Entities\Bizbos\Make\Status;
use App\Entities\Bizdos\Make\OutputBaseDo;
use App\Globals\Bizes\BaseBO;
use App\Globals\Bizes\BaseOutputDO;
use App\Interfaces\Entities\IChangeStatusable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 4/11/17
 * Time: 18:52
 *
 * Class StatusBaseBiz
 * @package App\Entities\Bizbos\Make\Status
 * @property-read int       $output_status
 */
abstract class StatusBaseBO extends BaseBO implements IChangeStatusable
{
    /**
     * @var OutputBaseDo
     */
    private $outputDo;

    protected function column()
    {
        return [
            'output_status'
        ];
    }

    /**
     * @param BaseOutputDO $outputDo
     * @return $this
     */
    final public function setOutputDo(BaseOutputDO $outputDo)
    {
        $this->outputDo = $outputDo;
        return $this;
    }

    /**
     * @return OutputBaseDo
     */
    final protected function getOutputDo()
    {
        return $this->outputDo;
    }

    /**
     * 设置状态为：已取消
     * @return mixed
     */
    public function changeCancelStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：订单关闭
     * @return mixed
     */
    public function changeCloseStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：确认(待配货)
     * @return mixed
     */
    public function changeConfirmStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：已发货
     * @return mixed
     */
    public function changeDeliveryStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：无退货订单完成
     * @return mixed
     */
    public function changeFinishAllStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：部分退货订单完成
     * @return mixed
     */
    public function changeFinishPartStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：已服务(美容院项目订单用)
     * @return mixed
     */
    public function changeHasServiceStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：已付定金(美容院项目订单用)
     * @return mixed
     */
    public function changePaidDepositStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：已付款
     * @return mixed
     */
    public function changePaidStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：已配货
     * @return mixed
     */
    public function changePrepareStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：已收货
     * @return mixed
     */
    public function changeReceiptStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：已退款
     * @return mixed
     */
    public function changeRefundedStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：退款处理中
     * @return mixed
     */
    public function changeRefundingStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：全部商品已退货完成
     * @return mixed
     */
    public function changeReturnedAllStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：部分商品已退货完成
     * @return mixed
     */
    public function changeReturnedPartStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：退货处理中
     * @return mixed
     */
    public function changeReturningStatus()
    {
        return $this;
    }

    /**
     * 设置状态为：未付款
     * @return mixed
     */
    public function changeUnpaidStatus()
    {
        return $this;
    }
}