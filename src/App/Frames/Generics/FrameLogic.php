<?php
namespace App\Frames\Generics;
use App\Datasets\Consts\ClassConst;
use App\Frames\FrameGeneric;
use App\Globals\Bases\BaseStore;
use App\Globals\Finals\Responder;
use App\Globals\Stores\FormStore;
use App\Helpers\JsonHelper;
use App\Interfaces\Generics\IRespondable;
use App\Unusually\BizLogicExceptions;
/**
 * 用来生成 Sqlang 和 Store 相关类的工厂类
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:10
 *
 * Class BaseLogic
 * @package App\Globals\Generics
 */
abstract class FrameLogic extends FrameGeneric implements IRespondable
{
    /**
     * @var FrameRepository
     */
    private $repository;

    /**
     * @var BaseStore
     */
    private $store;

    /**
     * @var string
     */
    private $bizDOPrefix;

    /**
     * @var string
     */
    private $bizBOPrefix;

    /**
     * @var bool
     */
    private $autocommit = true;

    /**
     * 如果需要持久化数据时，需要实现run 方法，但是要调用commit
     * @param Responder $responder
     * @return void
     */
    abstract protected function run(Responder $responder);


    final public function init(...$args)
    {
        $repository = $args[0];
        $this->repository = $repository;
        return $this;
    }

    /**
     * 设置是否自动提交
     * @param bool $auto        自动提交true,否则为false
     * @return $this
     */
    final protected function autoCommit($auto)
    {
        $this->autocommit=(bool)$auto;
        return $this;
    }

    /**
     * 设置 bizDO 类名称
     * @param string $bizDOPrefix
     * @return $this
     */
    final protected function setBizDOPrefix($bizDOPrefix=ClassConst::CLASS_PREFIX)
    {
        $this->bizDOPrefix = $bizDOPrefix;
        return $this;
    }

    /**
     * 设置 bizBO 类名称
     * @param string $bizBOPrefix
     * @return $this
     */
    final protected function setBizBOPrefix($bizBOPrefix=ClassConst::CLASS_PREFIX)
    {
        $this->bizBOPrefix = $bizBOPrefix;
        return $this;
    }

    public function get()
    {
        $this->beforeBegin();
        $responder = Responder::getInstance();
        $this->autocommit?$this->commit($responder):$this->transaction($responder);
        $this->afterEnd();
        return $responder;
    }

    /**
     * 持久化数据
     * @param Responder $responder
     * @return void
     */
    private function transaction(Responder $responder)
    {
        $dao = $this->getStore()->getCache()->getDao()->autocommit(NO);

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

    }

    /**
     * 自动化持久化数据
     * @param Responder $responder
     * @return void
     */
    private function commit(Responder $responder)
    {
        $this->getStore()->getCache()->getDao()->autocommit(YES);
        $this->run($responder);

        $responder->toggle ?
            $responder->msg = $this->t('global', 'save_success'):
            $responder->msg = $this->t('global', 'save_failure');
    }

    /**
     * @return FrameRepository
     */
    final protected function getRepositpry()
    {
        return $this->repository;
    }

    /**
     * @param BaseStore $store
     * @return $this
     */
    final protected function setStore(BaseStore $store)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @return BaseStore
     */
    final protected function getStore()
    {
        return $this->store;
    }

    /**
     * 获取BizDo类的全名
     * @return string
     */
    final protected function getBizDOClassString()
    {
        $this->bizDOPrefix || $this->setBizDOPrefix();
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActPath().BACKSLASH.$this->bizDOPrefix;
        $classname = $package.BACKSLASH.ClassConst::ENTITY_CATALOG.BACKSLASH.ClassConst::BIZDO_CATALOG.BACKSLASH.$path.ClassConst::DO_SUFFIX;
        return $classname;
    }

    /**
     * 获取BizBo类的全名
     * @return string
     */
    final protected function getBizBOClassString()
    {
        $this->bizBOPrefix || $this->setBizBOPrefix();
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActPath().BACKSLASH.$this->bizBOPrefix;
        $classname = $package.BACKSLASH.ClassConst::ENTITY_CATALOG.BACKSLASH.ClassConst::BIZBO_CATALOG.BACKSLASH.$path.ClassConst::DO_SUFFIX;
        return $classname;
    }

    protected function afterInstance()
    {
        $this->setStore(FormStore::getInstance());
    }

    /**
     * 钩子方法，主要是减少事务当中的时间消耗
     */
    protected function beforeBegin() {}

    /**
     * 钩子方法，主要是减少事务当中的时间消耗
     */
    protected function afterEnd(){}
}