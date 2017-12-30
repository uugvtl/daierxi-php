<?php
namespace App\Network\Generics\Queries;
use App\Globals\Generics\BaseContainer;
use App\Helpers\InstanceHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:38
 *
 * Class GenericContainer
 * @package App\Network\Generics\Queries
 */
abstract class GenericContainer extends BaseContainer
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