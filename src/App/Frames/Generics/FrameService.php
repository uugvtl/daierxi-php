<?php
namespace App\Frames\Generics;
use App\Datasets\Consts\DataConst;
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

    /**
     * 设置 相关模块 Repository 的基类名称
     * @return $this
     */
    final protected function setBaseRepositoryString()
    {
        $this->getGenericInjecter()->setBaseClassString('AppRepository');
        return $this;
    }

    /**
     * 设置 相关模块 Logic 的基类名称
     * @return $this
     */
    final protected function setBaseLogicString()
    {
        $this->getGenericInjecter()->setBaseClassString('AppLogic');
        return $this;
    }

    /**
     * 创造 Repository 实例
     * @return FrameRepository
     */
    protected function madeRepositoryInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->setBaseRepositoryString();
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(FrameRepository::class, $repositoryName);
        return $repository->setGenericInjecter($cloneGenericInjecter);
    }

    /**
     * 创造 Logic 实例
     * @return FrameLogic
     */
    protected function madeLogicInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();
        $this->setBaseLogicString();
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $logic = $instanceHelper->build(FrameLogic::class, $logicName);
        return $logic->setGenericInjecter($cloneGenericInjecter);
    }


    /**
     * 得到 Repository 类的命名字符串
     * @return string
     */
    protected function getRepositoryClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();

        if($genericInjecter->hasGeneralize())
        {
            $path = $genericInjecter->getDistributer()->getCtrlActPath();

            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Repositories'.BACKSLASH.$path.'Repository';
        }
        else
        {
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Repositories'.BACKSLASH.$genericInjecter->getBaseClassString();

        }

        return $classname;
    }


    /**
     * 得到 Logic 类的命名字符串
     * @return string
     */
    protected function getLogicClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();

        if($genericInjecter->hasGeneralize())
        {
            $path = $genericInjecter->getDistributer()->getCtrlActPath();
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Logics'.BACKSLASH.$path.'Logic';
        }
        else
        {
            $classname = $package.BACKSLASH.DataConst::FACTORY_CATALOG .BACKSLASH.'Logics'.BACKSLASH.$genericInjecter->getBaseClassString();
        }

        return $classname;
    }

    /**
     * 得到 Legal 类的命名字符串
     * @return string
     */
    protected function getLegalClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActPath();
        $classname = $package.BACKSLASH.'Legals'.BACKSLASH.$path.'Legal';
        return $classname;
    }

}