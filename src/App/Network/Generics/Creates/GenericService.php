<?php
namespace App\Network\Generics\Creates;
use App\Globals\Generics\BaseService;
use App\Helpers\InstanceHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:05
 *
 * Class GenericService
 * @package App\Network\Generics\Creates
 */
abstract class GenericService extends BaseService
{
    /**
     * @return GenericRepository
     */
    protected function createRepositoryInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('CreateRepository');
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(GenericRepository::class, $repositoryName);
        return $repository->setGenericInjecter($cloneGenericInjecter);
    }

    /**
     * @return GenericLogic
     */
    protected function createLogicInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->$this->getGenericInjecter()->setBaseClassString('CreateLogic');
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();



        $logic = $instanceHelper->build(GenericLogic::class, $logicName);
        return $logic->setGenericInjecter($cloneGenericInjecter);
    }
}