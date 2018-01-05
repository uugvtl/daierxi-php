<?php
namespace App\Network\Modules\Manager\Generics\Exports\Factories\Services;
use App\Network\Generics\Exports\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:29
 *
 * Class ExportService
 * @package App\Network\Modules\Manager\Generics\Exports\Factories\Services
 */
class ExportService extends GenericService
{
    public function get()
    {
        $repository = $this->createRepositoryInstance();
        $logic = $this->createLogicInstance();
        return $logic->init($repository)->get();
    }
}