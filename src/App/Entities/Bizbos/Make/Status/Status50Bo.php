<?php
namespace App\Entities\Bizbos\Make\Status;
use App\Datasets\Consts\OutputStatusConst;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/5/4
 * Time: 19:14
 *
 * Class Status50Entity
 * @package App\Entities\Bizbos\Make\Status
 */
class Status50Bo extends StatusBaseBo
{
    protected function afterInstance()
    {
        $this->output_status = OutputStatusConst::STATUS_RECEIPT;
    }

    public function changeReceiptStatus()
    {
        $this->getOutputDo()->setProperty('output_status', $this->output_status);
        return $this;
    }

    public function changeFinishAllStatus()
    {
        $outputDo = $this->getOutputDo();
        $statusBo = $outputDo->createStatusBo(OutputStatusConst::STATUS_FINISH_ALL);
        $outputDo->setStatusBo($statusBo);
        $outputDo->changeFinishAllStatus();
        return $this;
    }
}