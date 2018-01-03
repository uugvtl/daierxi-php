<?php
namespace App\Frames\Generics;
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

    abstract protected function createRepositoryInstance();

    abstract protected function createLogicInstance();

    /**
     * @return string
     */
    final protected function getRepositoryClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();

        if($genericInjecter->hasGeneralize())
        {
            $path = $genericInjecter->getDistributer()->getPath();

            $classname = $package.BACKSLASH.'Repositories'.BACKSLASH.$path.'Repository';
        }
        else
        {
            $classname = $package.BACKSLASH.'Repositories'.BACKSLASH.$genericInjecter->getBaseClassString();

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
            $path = $genericInjecter->getDistributer()->getPath();
            $classname = $package.BACKSLASH.'Logics'.BACKSLASH.$path.'Logic';
        }
        else
        {
            $classname = $package.BACKSLASH.'Logics'.BACKSLASH.$genericInjecter->getBaseClassString();
        }

        return $classname;
    }
}