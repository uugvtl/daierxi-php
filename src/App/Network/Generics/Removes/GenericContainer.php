<?php
namespace App\Network\Generics\Removes;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:38
 *
 * Class GenericContainer
 * @package App\Network\Generics\Removes
 */
abstract class GenericContainer extends FrameContainer
{
    /**
     * @return GenericService
     */
    protected function madeService()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('RemoveService');
        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(GenericService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter->init($serviceInstance));

        return $serviceInstance;
    }
}