<?php
namespace App\Network\Generics\Queries;
use App\Frames\Generics\FrameService;
use App\Helpers\InstanceHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:44
 *
 * Class GenericService
 * @package App\Network\Generics\Queries
 */
abstract class GenericService extends FrameService
{

    /**
     * @return GenericRepository
     */
    protected function madeRepositoryInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('QueryRepository');
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(GenericRepository::class, $repositoryName);
        $repository->setGenericInjecter($cloneGenericInjecter);

        return $repository;
    }

    /**
     * @return GenericLogic
     */
    protected function madeLogicInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('QueryLogic');
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $logic = $instanceHelper->build(GenericLogic::class, $logicName);
        $logic->setGenericInjecter($cloneGenericInjecter);

        return $logic;
    }

}
