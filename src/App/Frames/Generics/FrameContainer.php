<?php
namespace App\Frames\Generics;
use App\Console\Generics\Crontabs\GenericService;
use App\Datasets\DataConst;
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
     * @return Responder
     */
    abstract public function get();


    abstract protected function setBaseServiceString();

    /**
     * @return GenericService
     */
    final protected function madeService()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->setBaseServiceString();

        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(GenericService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter->init($serviceInstance));

        return $serviceInstance;
    }


    private function getServiceClassString()
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