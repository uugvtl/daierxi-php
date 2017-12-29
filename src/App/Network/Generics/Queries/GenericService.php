<?php
namespace App\Network\Generics\Queries;
use App\Globals\Bases\BaseGeneric;
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
abstract class GenericService extends BaseGeneric
{

    final protected function createRepositoryInstance()
    {
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getCloneGenericInjecter();

        $repository = $instanceHelper->build(GenericRepository::class, $repositoryName);
        return $repository->setGenericInjecter($genericInjecter);
    }

    /**
     * @return string
     */
    private function getRepositoryClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();

        if($this->getGenericInjecter()->hasGeneralize())
        {
            $path = $genericInjecter->getDistributer()->getPath();

            $classname = $package.BACKSLASH.'Repositories'.BACKSLASH.$path.'Repository';
        }
        else
        {
            $classname = $package.BACKSLASH.'Repositories'.BACKSLASH.'QueryRepository';

        }

        return $classname;
    }

}
