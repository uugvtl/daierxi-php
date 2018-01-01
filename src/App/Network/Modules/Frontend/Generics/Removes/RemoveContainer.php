<?php
namespace App\Network\Modules\Frontend\Generics\Removes;
use App\Helpers\InstanceHelper;
use App\Network\Generics\Removes\GenericContainer;
use App\Network\Modules\Frontend\Generics\Removes\Services\RemoveService;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 19:45
 *
 * Class RemoveContainer
 * @package App\Network\Modules\Frontend\Generics\Removes
 */
class RemoveContainer extends GenericContainer
{
    public function get()
    {

    }

    /**
     * @return RemoveService
     */
    protected function createService()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('RemoveService');
        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(RemoveService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter);

        return $serviceInstance;

    }
}