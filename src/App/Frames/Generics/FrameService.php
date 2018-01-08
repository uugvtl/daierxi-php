<?php
namespace App\Frames\Generics;
use App\Datasets\DataConst;
use App\Frames\FrameGeneric;
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
abstract class FrameService extends FrameGeneric
{

    abstract protected function madeRepositoryInstance();

    abstract protected function madeLogicInstance();

    /**
     * @return string
     */
    final protected function getRepositoryClassString()
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
    final protected function getLogicClassString()
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