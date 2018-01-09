<?php
namespace App\Frames\Generics;
use App\Datasets\DataConst;
use App\Frames\FrameGeneric;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IRespondable;
/**
 * 用来生成 Repository 和 Logic 相关类的工厂类
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 11:31
 *
 * Class BaseService
 * @package App\Globals\Generics
 */
abstract class FrameService extends FrameGeneric implements IRespondable
{

//    abstract protected function madeRepositoryInstance();
//
//    abstract protected function madeLogicInstance();

    /**
     * 设置 相关模块 Repository 的基类名称
     * @return $this
     */
    abstract protected function setBaseRepositoryString();

    /**
     * 设置 相关模块 Logic 的基类名称
     * @return $this
     */
    abstract protected function setBaseLogicString();

    /**
     * @return FrameRepository
     */
    protected function madeRepositoryInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->setBaseRepositoryString();
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(FrameRepository::class, $repositoryName);
        return $repository->setGenericInjecter($cloneGenericInjecter->init($repository));
    }

    /**
     * @return FrameLogic
     */
    protected function madeLogicInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();
        $this->setBaseLogicString();
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $logic = $instanceHelper->build(FrameLogic::class, $logicName);
        return $logic->setGenericInjecter($cloneGenericInjecter->init($logic));
    }


    /**
     * @return string
     */
    private function getRepositoryClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();

        if($genericInjecter->hasGeneralize())
        {
            $path = $genericInjecter->getDistributer()->getCtrlActFilePath();

            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Repositories'.BACKSLASH.$path.'Repository';
        }
        else
        {
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Repositories'.BACKSLASH.$genericInjecter->getBaseClassString();

        }

        return $classname;
    }


    /**
     * @return string
     */
    private function getLogicClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();

        if($genericInjecter->hasGeneralize())
        {
            $path = $genericInjecter->getDistributer()->getCtrlActFilePath();
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Logics'.BACKSLASH.$path.'Logic';
        }
        else
        {
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Logics'.BACKSLASH.$genericInjecter->getBaseClassString();
        }

        return $classname;
    }

    /**
     *
     */
    protected function getLegalClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActFilePath();
        $classname = $package.BACKSLASH.'Legals'.BACKSLASH.$path.'Legal';
        return $classname;
    }

}