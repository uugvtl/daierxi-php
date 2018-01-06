<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Services;
use App\Network\Generics\Removes\GenericService;
class RemoveService extends GenericService
{
    public function get()
    {
        $repository = $this->madeRepositoryInstance();
        $logic = $this->madeLogicInstance();
        return $logic->init($repository)->get();
    }
}