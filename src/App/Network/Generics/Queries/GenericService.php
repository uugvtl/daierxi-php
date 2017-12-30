<?php
namespace App\Network\Generics\Queries;
use App\Globals\Generics\BaseService;
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
abstract class GenericService extends BaseService
{

    protected function createRepositoryInstance()
    {
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter()->getClone();

        $repository = $instanceHelper->build(GenericRepository::class, $repositoryName);
        return $repository->setGenericInjecter($genericInjecter);
    }

    protected function createLogicInstance()
    {
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter()->getClone();

        $logic = $instanceHelper->build(GenericLogic::class, $logicName);
        return $logic->setGenericInjecter($genericInjecter);
    }

}
