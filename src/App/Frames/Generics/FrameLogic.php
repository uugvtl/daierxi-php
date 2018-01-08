<?php
namespace App\Frames\Generics;
use App\Frames\FrameGeneric;
use App\Globals\Bases\BaseStore;
use App\Globals\Finals\Responder;
use App\Globals\Stores\FormStore;
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
abstract class FrameLogic extends FrameGeneric
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
    protected function getBizDoClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActFilePath();
        $classname = $package.BACKSLASH.'Entities'.BACKSLASH.'Bizdos'.BACKSLASH.$path.'Do';
        return $classname;
    }

    /**
     * 获取BizBo类的全名
     * @return string
     */
    protected function getBizBoClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActFilePath();
        $classname = $package.BACKSLASH.'Entities'.BACKSLASH.'Bizbos'.BACKSLASH.$path.'Bo';
        return $classname;
    }

    protected function afterInstance()
    {
        $this->setStore(FormStore::getInstance());
    }
}