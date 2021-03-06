<?php
namespace App\Entities\Bizbos\Make\Status;
use App\Datasets\Consts\OutputStatusConst;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/5/4
 * Time: 19:14
 *
 * Class Status40Entity
 * @package App\Entities\Bizbos\Make\Status
 */
class Status40Bo extends StatusBaseBO
{
    protected function afterInstance()
    {
        $this->output_status = OutputStatusConst::STATUS_DELIVERY;
    }

    public function changeDeliveryStatus()
    {
        $this->getOutputDo()->setProperty('output_status', $this->output_status);
        return $this;
    }

    public function changeReceiptStatus()
    {
        $outputDo = $this->getOutputDo();
        $statusBo = $outputDo->madeStatusBo(OutputStatusConst::STATUS_RECEIPT);
        $outputDo->setStatusBo($statusBo);
        $outputDo->changeReceiptStatus();
        return $this;
    }
}