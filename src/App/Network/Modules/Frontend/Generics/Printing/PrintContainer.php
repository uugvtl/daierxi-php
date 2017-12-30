<?php
namespace App\Network\Modules\Frontend\Generics\Printing;
use App\Helpers\InstanceHelper;
use App\Network\Generics\Printing\GenericContainer;
use App\Network\Modules\Frontend\Generics\Printing\Services\PrintService;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 19:52
 *
 * Class PrintContainer
 * @package App\Network\Modules\Frontend\Generics\Printing
 */
class PrintContainer extends GenericContainer
{
    public function run()
    {
    }

    /**
     * @return PrintService
     */
    protected function createService()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('PrintService');
        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(PrintService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter);

        return $serviceInstance;

    }
}