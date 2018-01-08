<?php
namespace App\Frames\Generics;
use App\Datasets\DataConst;
use App\Frames\FrameGeneric;
use App\Globals\Finals\Responder;
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
     * @return Responder
     */
    abstract public function get();

    /**
     * @return mixed
     */
    abstract protected function madeService();

    final protected function getServiceClassString()
    {

        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getCtrlActFilePath();


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