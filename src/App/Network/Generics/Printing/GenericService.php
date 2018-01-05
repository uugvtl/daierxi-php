<?php
namespace App\Network\Generics\Printing;
use App\Frames\Generics\FrameService;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IPrintable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:44
 *
 * Class GenericService
 * @package App\Network\Generics\Queries
 */
abstract class GenericService extends FrameService implements IPrintable
{

    protected function createRepositoryInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('PrintRepository');
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(GenericRepository::class, $repositoryName);
        return $repository->setGenericInjecter($cloneGenericInjecter);
    }

    protected function createLogicInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('PrintLogic');
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();



        $logic = $instanceHelper->build(GenericLogic::class, $logicName);
        return $logic->setGenericInjecter($cloneGenericInjecter);
    }

}
