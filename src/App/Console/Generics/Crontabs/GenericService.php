<?php
namespace App\Console\Generics\Crontabs;
use App\Frames\Generics\FrameService;
use App\Helpers\InstanceHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:48
 *
 * Class GenericService
 * @package App\Console\Generics\Crontabs
 */
abstract class GenericService extends FrameService
{
    /**
     * @return GenericRepository
     */
    protected function madeRepositoryInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('CreateRepository');
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(GenericRepository::class, $repositoryName);
        return $repository->setGenericInjecter($cloneGenericInjecter->init($repository));
    }

    /**
     * @return GenericLogic
     */
    protected function madeLogicInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('CreateLogic');
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $logic = $instanceHelper->build(GenericLogic::class, $logicName);
        return $logic->setGenericInjecter($cloneGenericInjecter->init($logic));
    }
}