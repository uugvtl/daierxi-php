<?php
namespace App\Network\Modules\Manager\Generics\Printing\Factories\Services;
use App\Network\Generics\Printing\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 17:56
 *
 * Class PrintService
 * @package App\Network\Modules\Manager\Generics\Printing\Factories\Servies
 */
class PrintService extends GenericService
{
    public function get()
    {
        $repository = $this->createRepositoryInstance();
        $logic = $this->createLogicInstance();
        return $logic->init($repository)->get();
    }
}