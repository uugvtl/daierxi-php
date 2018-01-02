<?php
namespace App\Console\Modules\Mission\Generics\Initializes\Services;
use App\Console\Generics\Initializes\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 15:20
 *
 * Class InitializeServices
 * @package App\Console\Modules\Mission\Generics\Initializes\Services
 */
class InitializeServices extends GenericService
{
    public function get()
    {
        $repository = $this->createRepositoryInstance();
        return $repository->get();
    }
}