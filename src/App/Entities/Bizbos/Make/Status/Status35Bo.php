<?php
namespace App\Entities\Bizbos\Make\Status;
use App\Datasets\Consts\OutputStatusConst;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 4/11/17
 * Time: 19:05
 *
 * Class Status35Biz
 * @package App\Globals\Objects\Entities\Make\Status
 */
class Status35Bo extends StatusBaseBo
{
    protected function afterInstance()
    {
        $this->output_status = OutputStatusConst::STATUS_PREPARE;
    }


    public function changePrepareStatus()
    {
        $this->getOutputDo()->setProperty('output_status', $this->output_status);
        return $this;
    }

    public function changeDeliveryStatus()
    {
        $outputDo = $this->getOutputDo();
        $statusBo = $outputDo->createStatusBo(OutputStatusConst::STATUS_DELIVERY);
        $outputDo->setStatusBo($statusBo);
        $outputDo->changeDeliveryStatus();
        return $this;
    }
}