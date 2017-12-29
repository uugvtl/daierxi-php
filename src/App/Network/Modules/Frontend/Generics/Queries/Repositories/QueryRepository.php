<?php
namespace App\Network\Modules\Frontend\Generics\Queries\Repositories;
use App\Globals\Finals\Responder;
use App\Network\Generics\Queries\GenericRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 01:51
 *
 * Class QueryRepository
 * @package App\Network\Modules\Manager\Generics\Queries\Repositories
 */
class QueryRepository extends GenericRepository
{
    public function run()
    {
//        $store = $this->createStoreInstance();
        return Responder::getInstance();
    }

}