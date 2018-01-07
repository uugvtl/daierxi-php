<?php
namespace App\Network\Generics\Removes;
use App\Globals\Finals\Responder;
use App\Frames\Generics\FrameLogic;
use App\Helpers\JsonHelper;
use App\Interfaces\Generics\IRespondable;
use App\Unusually\BizLogicExceptions;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericLogic
 * @package App\Network\Generics\Removes
 */
abstract class GenericLogic  extends FrameLogic implements IRespondable
{
    final public function get()
    {
        $responder = Responder::getInstance();
        $this->transaction($responder);
        return $responder;
    }

    /**
     * 持久化数据
     * @param Responder $responder
     * @return void
     */
    final protected function transaction(Responder $responder)
    {
        $dao = $this->getStore()->getCache()->getDao();
        $this->beforeBegin();

        try {

            $dao->start();
            $this->run($responder);
            $dao->end();

        }
        catch(BizLogicExceptions $e) {
            $dao->rollback();
            $jsonHelper = JsonHelper::getInstance();
            $jsonHelper->sendExcp($e);
        }

        $this->afterEnd();

        $responder->toggle ?
            $responder->msg=$this->t('global', 'delete_success'):
            $responder->msg=$this->t('errors', 'invalid_delete');
    }

    /**
     * 钩子方法，主要是减少事务当中的时间消耗
     */
    protected function beforeBegin() {}

    protected function afterEnd(){}
}