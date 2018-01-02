<?php
namespace App\Console\Generics\Initializes;
use App\Globals\Generics\BaseContainer;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IRespondable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:47
 *
 * Class GenericContainer
 * @package App\Console\Generics\Initializes
 */
abstract class GenericContainer extends BaseContainer implements IRespondable
{
    /**
     * @return GenericService
     */
    protected function createService()
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