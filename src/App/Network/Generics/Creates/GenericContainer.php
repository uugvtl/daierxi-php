<?php
namespace App\Network\Generics\Creates;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IRespondable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:41
 *
 * Class GenericContainer
 * @package App\Network\Generics\Creates
 */
abstract class GenericContainer extends FrameContainer implements IRespondable
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
        $serviceInstance->setGenericInjecter($cloneGenericInjecter);

        return $serviceInstance;
    }

}