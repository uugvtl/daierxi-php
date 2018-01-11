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
class AppService extends GenericService
{
    public function get()
    {
        $repository = $this->madeRepositoryInstance();
        $logic = $this->madeLogicInstance();
        return $logic->init($repository)->get();
    }
}