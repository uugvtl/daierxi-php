<?php
namespace App\Entities\Bizbos\Make\Status;
use App\Datasets\Consts\OutputStatusConst;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 4/11/17
 * Time: 18:59
 *
 * Class Status30Biz
 * @package App\Entities\Bizbos\Make\Status
 */
class Status30Bo extends StatusBaseBo
{
    protected function afterInstance()
    {
        $this->output_status = OutputStatusConst::STATUS_CONFIRM;
    }

    public function changeConfirmStatus()
    {
        $this->getOutputDo()->setProperty('output_status', $this->output_status);
        return $this;
    }

    public function changePrepareStatus()
    {
        $bizDo = $this->getOutputDo();
        $statusBo = $bizDo->madeStatusBo(OutputStatusConst::STATUS_PREPARE);
        $bizDo->setStatusBo($statusBo);
        $bizDo->changePrepareStatus();
        return $this;
    }
}