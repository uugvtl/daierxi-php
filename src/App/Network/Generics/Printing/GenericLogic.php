<?php
namespace App\Network\Generics\Printing;
use App\Adapters\Printing\PdfPrintAdapter;
use App\Globals\Finals\Responder;
use App\Frames\Generics\FrameLogic;
use App\Globals\Stores\SelectStore;
use App\Helpers\JsonHelper;
use App\Interfaces\Adapters\IPrintAdapter;
use App\Interfaces\Generics\IPrintable;
use App\Unusually\BizLogicExceptions;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericLogic
 * @package App\Network\Generics\Queries
 */
abstract class GenericLogic  extends FrameLogic implements IPrintable
{
    /**
     * @var IPrintAdapter
     */
    private $adapter;

    /**
     * @return IPrintAdapter
     */
    final protected function getAdapter()
    {
        $this->adapter || $this->adapter = PdfPrintAdapter::getInstance();
        return $this->adapter;
    }

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
        $toggle = false;
        $dao = $this->getStore()->getCache()->getDao();

        $this->beforeBegin();

        try {

            $dao->start();
            $toggle = $this->commit();
            $dao->end();
        }
        catch(BizLogicExceptions $e) {
            $dao->rollback();
            $jsonHelper = JsonHelper::getInstance();
            $jsonHelper->sendExcp($e);
        }

        $toggle && $this->run($responder);
    }

    final protected function afterInstance()
    {
        $this->setStore(SelectStore::getInstance());
    }

    /**
     * 钩子方法，主要是减少事务当中的时间消耗
     */
    protected function beforeBegin() {}

    /**
     * 处理数据库相关逻辑
     * @return boolean
     */
    abstract protected function commit();
}