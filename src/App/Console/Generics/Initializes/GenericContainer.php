<?php
namespace App\Console\Generics\Initializes;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:47
 *
 * Class GenericContainer
 * @package App\Console\Generics\Initializes
 */
abstract class GenericContainer extends FrameContainer
{
    /**
     * @return GenericService
     */
    protected function madeService()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('GenericService');
        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(GenericService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter->init($serviceInstance));

        return $serviceInstance;
    }
}