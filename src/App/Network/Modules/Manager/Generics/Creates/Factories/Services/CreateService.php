<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services;
use App\Network\Generics\Creates\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 00:18
 *
 * Class CreateService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services
 */
class CreateService extends GenericService
{
    public function get()
    {
        $repository = $this->madeRepositoryInstance();
        $logic = $this->madeLogicInstance();
        return $logic->init($repository)->get();
    }
}