<?php
namespace App\Frames\Generics;
use App\Datasets\Consts\DataConst;
use App\Frames\FrameGeneric;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IRespondable;
/**
 * 用来生成 Service 相关类的工厂类
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:39
 *
 * Class BaseContainer
 * @package App\Globals\Generics
 */
abstract class FrameContainer extends FrameGeneric implements IRespondable
{
    /**
     * @var bool
     */
    private $invokeSetBaseServicePrefixMothed;

    /**
     * @return Responder
     */
    abstract public function get();

    /**
     * 设置 相关模块 Service 的基类名称
     * @param string $baseServicePrefix     基类名称前辍
     * @return $this
     */
    final public function setBaseServicePrefix($baseServicePrefix=DataConst::CLASS_PREFIX)
    {
        $this->invokeSetBaseServicePrefixMothed = YES;
        $baseClassString = $baseServicePrefix.'Service';
        $this->getGenericInjecter()->setBaseClassString($baseClassString);
        return $this;
    }

    /**
     * @return FrameService
     */
    final protected function madeService()
    {
        $this->invokeSetBaseServicePrefixMothed || $this->setBaseServicePrefix();

        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(FrameService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter);

        return $serviceInstance;
    }


    protected function getServiceClassString()
    {

        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActPath();


        if($genericInjecter->hasGeneralize())
        {
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG . BACKSLASH.'Services'.BACKSLASH.$path.'Service';
        }
        else
        {
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG . BACKSLASH.'Services'.BACKSLASH.$genericInjecter->getBaseClassString();
        }

        return $classname;
    }
}