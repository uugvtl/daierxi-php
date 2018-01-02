<?php
namespace App\Globals\Generics;
use App\Globals\Bases\BaseGeneric;
use App\Globals\Bizes\BaseDo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Helpers\JsonHelper;
use App\Libraries\Daoes\AppDao;
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
abstract class BaseLogic extends BaseGeneric
{
    /**
     * @var BaseRepository
     */
    private $repository;

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
     * @return BaseRepository
     */
    final protected function getRepositpry()
    {
        return $this->repository;
    }

    /**
     * 持久化数据
     * @param Responder $responder
     * @return void
     */
    final protected function commit(Responder $responder)
    {
        $dao = AppDao::getInstance();
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
     * 获取相关的实体类--可以进行override使用默认类
     * @param array $params             实体需要的初始化参数
     * @return BaseDo
     */
    protected function createBizDo(array $params)
    {
        $instanceHelper = InstanceHelper::getInstance();
        $bizDo = $instanceHelper->build(BaseDo::class, $this->getBizDoClassString());
        return $bizDo->init($params);
    }

    /**
     * 获取相关的实体类--可以进行override使用默认类
     * @param array $params             实体需要的初始化参数
     * @return BaseDo
     */
    protected function createBizBo(array $params)
    {
        $instanceHelper = InstanceHelper::getInstance();
        $bizDo = $instanceHelper->build(BaseDo::class, $this->getBizBoClassString());
        return $bizDo->init($params);
    }


    /**
     * 获取BizDo类的全名
     * @return string
     */
    private function getBizDoClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getPath();
        $classname = $package.BACKSLASH.'Entities'.BACKSLASH.'Bizdos'.BACKSLASH.$path.'Do';
        return $classname;
    }

    /**
     * 获取BizBo类的全名
     * @return string
     */
    private function getBizBoClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getPath();
        $classname = $package.BACKSLASH.'Entities'.BACKSLASH.'Bizbos'.BACKSLASH.$path.'Bo';
        return $classname;
    }

}