<?php
namespace App\Network\Modules\Frontend\Generics\Queries\Services;
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
        $repository = $this->createRepositoryInstance();
        return $repository->run();
    }

}