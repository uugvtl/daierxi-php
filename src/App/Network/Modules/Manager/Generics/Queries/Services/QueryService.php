<?php
namespace App\Network\Modules\Manager\Generics\Queries\Services;
use App\Creators\BaseCreator;
use App\Creators\Generics\Queries\RepositoryCreator;
use App\Network\Generics\Queries\GenericService;
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

    /**
     * @var BaseCreator
     */
    private $repositoryCreator;

    public function run()
    {
        $this->repositoryCreator = RepositoryCreator::getInstance();
        $this->repositoryCreator->init($this->getGenericInjecter());

        $repository = $this->repositoryCreator->create(QueryRepository::class);
        $repository->run();
    }
}