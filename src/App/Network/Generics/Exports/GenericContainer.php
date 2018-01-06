<?php
namespace App\Network\Generics\Exports;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IExportable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:41
 *
 * Class GenericContainer
 * @package App\Network\Generics\Exports
 */
abstract class GenericContainer extends FrameContainer implements IExportable
{
    /**
     * @return GenericService
     */
    protected function madeService()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('ExportService');
        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(GenericService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter);

        return $serviceInstance;
    }

}