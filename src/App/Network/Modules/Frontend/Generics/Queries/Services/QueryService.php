<?php
namespace App\Network\Modules\Frontend\Generics\Queries\Services;
use App\Globals\Finals\Responder;
use App\Network\Generics\Queries\GenericService;
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
        return Responder::getInstance();
//        $this->repositoryCreator = RepositoryCreator::getInstance();
//        $this->repositoryCreator->init($this->getGenericInjecter());
//
//        $repository = $this->repositoryCreator->create(QueryRepository::class);
//        $repository->run();
    }
}