<?php
namespace App\Console\Generics\Initializes;
use App\Globals\Generics\BaseService;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IRespondable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:48
 *
 * Class GenericService
 * @package App\Console\Generics\Initializes
 */
abstract class GenericService extends BaseService implements IRespondable
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