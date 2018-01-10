<?php
namespace App\Frames\Generics;
use App\Datasets\Consts\ClassConst;
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
     * @var bool
     */
    private $invokedSetBaseLogicPrefixMothed;

    /**
     * @var bool
     */
    private $invokedSetBaseRepositoryPrefixMothed;

    /**
     * 设置 相关模块 Repository 的基类名称
     * @param string $baseRepositoryPrefix      基类名称前辍
     * @return $this
     */
    final public function setBaseRepositoryPrefix($baseRepositoryPrefix=ClassConst::CLASS_PREFIX)
    {
        $this->invokedSetBaseRepositoryPrefixMothed = YES;
        $baseClassString = $baseRepositoryPrefix. ClassConst::REPOSITORY_SUFFIX;
        $this->getGenericInjecter()->setBaseClassString($baseClassString);
        return $this;
    }

    /**
     * 设置 相关模块 Logic 的基类名称
     * @param string $baseLogicPrefix           基类名称前辍
     * @return $this
     */
    final public function setBaseLogicPrefix($baseLogicPrefix=ClassConst::CLASS_PREFIX)
    {
        $this->invokedSetBaseLogicPrefixMothed = YES;
        $baseClassString = $baseLogicPrefix.ClassConst::LOGIC_SUFFIX;
        $this->getGenericInjecter()->setBaseClassString($baseClassString);
        return $this;
    }

    /**
     * 创造 Repository 实例
     * @return FrameRepository
     */
    protected function madeRepositoryInstance()
    {
        $this->invokedSetBaseRepositoryPrefixMothed || $this->setBaseRepositoryPrefix();

        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

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
        $this->invokedSetBaseLogicPrefixMothed || $this->setBaseLogicPrefix();
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();
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

            $classname = $package.BACKSLASH.ClassConst::FACTORY_CATALOG .BACKSLASH.ClassConst::REPOSITORY_CATALOG.BACKSLASH.$path.ClassConst::REPOSITORY_SUFFIX;
        }
        else
        {
            $classname = $package.BACKSLASH.ClassConst::FACTORY_CATALOG .BACKSLASH.ClassConst::REPOSITORY_CATALOG.BACKSLASH.$genericInjecter->getBaseClassString();

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
            $classname = $package.BACKSLASH.ClassConst::FACTORY_CATALOG .BACKSLASH.ClassConst::LOGIC_CATALOG.BACKSLASH.$path.ClassConst::LOGIC_SUFFIX;
        }
        else
        {
            $classname = $package.BACKSLASH.ClassConst::FACTORY_CATALOG .BACKSLASH.ClassConst::LOGIC_CATALOG.BACKSLASH.$genericInjecter->getBaseClassString();
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
        $classname = $package.BACKSLASH.ClassConst::LEGAL_CATALOG.BACKSLASH.$path. ClassConst::LEGAL_SUFFIX;
        return $classname;
    }

}