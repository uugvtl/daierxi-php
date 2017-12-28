<?php
namespace App\Network\Modules\Frontend\Generics\Queries\Services;
use App\Helpers\InstanceHelper;
use App\Network\Generics\Queries\GenericService;
use App\Network\Modules\Frontend\Generics\Queries\Logics\QueryLogic;
use App\Network\Modules\Frontend\Generics\Queries\Repositories\QueryRepository;

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
        $repository = $this->createRepository();
        return $repository->run();
    }


    protected function createRepository()
    {
        $repositoryName = $this->getRepositoryName();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(QueryRepository::class, $repositoryName);
        return $repository->setGenericInjecter($this->getGenericInjecter()->getClone());
    }

    protected function createLogic()
    {
        $logicName      = $this->getLogicName();
        $instanceHelper = InstanceHelper::getInstance();

        $logic = $instanceHelper->build(QueryLogic::class, $logicName);
        return $logic->setGenericInjecter($this->getGenericInjecter()->getClone());
    }

    /**
     * @return string
     */
    private function getRepositoryName()
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
    private function getLogicName()
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