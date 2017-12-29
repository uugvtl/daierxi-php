<?php
namespace App\Network\Modules\Manager\Generics\Queries\Services;
use App\Helpers\InstanceHelper;
use App\Network\Generics\Queries\GenericService;
use App\Network\Modules\Manager\Generics\Queries\Logics\QueryLogic;
use App\Network\Modules\Manager\Generics\Queries\Repositories\QueryRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 01:50
 *
 * Class QueryService
 * @package App\Network\Modules\Manager\Generics\Queries\Services
 */
class QueryService extends GenericService
{

    public function run()
    {
        $repository = $this->createRepositoryInstance();
        return $repository->run();
    }


    final protected function createRepositoryInstance()
    {
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getCloneGenericInjecter();

        $repository = $instanceHelper->build(QueryRepository::class, $repositoryName);
        return $repository->setGenericInjecter($genericInjecter);
    }

    final protected function createLogicInstance()
    {
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getCloneGenericInjecter();

        $logic = $instanceHelper->build(QueryLogic::class, $logicName);
        return $logic->setGenericInjecter($genericInjecter);
    }

    /**
     * @return string
     */
    private function getRepositoryClassString()
    {
        $genericInjecter = $this->getGenericInjecter();

        if($this->getGenericInjecter()->hasGeneralize())
        {
            $package = $genericInjecter->getPackage();
            $path = $genericInjecter->getDistributer()->getPath();

            $classname = $package.BACKSLASH.$path.'Repository';
        }
        else
        {
            $classname = QueryRepository::class;

        }

        return $classname;
    }

    /**
     * @return string
     */
    private function getLogicClassString()
    {
        $genericInjecter = $this->getGenericInjecter();

        if($this->getGenericInjecter()->hasGeneralize())
        {
            $package = $genericInjecter->getPackage();
            $path = $genericInjecter->getDistributer()->getPath();

            $classname = $package.BACKSLASH.$path.'Logic';
        }
        else
        {
            $classname = QueryLogic::class;

        }

        return $classname;
    }
}