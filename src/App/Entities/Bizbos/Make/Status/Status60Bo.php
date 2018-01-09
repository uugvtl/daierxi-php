<?php
namespace App\Entities\Bizbos\Make\Status;
use App\Datasets\Consts\OutputStatusConst;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/5/4
 * Time: 19:14
 *
 * Class Status60Entity
 * @package App\Entities\Bizbos\Make\Status
 */
class Status60Bo extends StatusBaseBO
{
    protected function afterInstance()
    {
        $this->output_status = OutputStatusConst::STATUS_FINISH_ALL;
    }

    public function changeFinishAllStatus()
    {
        $this->getOutputDo()->setProperty('output_status', $this->output_status);
        return $this;
    }
}