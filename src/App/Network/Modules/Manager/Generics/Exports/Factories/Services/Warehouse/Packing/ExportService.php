<?php
namespace App\Network\Modules\Manager\Generics\Exports\Factories\Services\Warehouse\Packing;
use App\Network\Modules\Manager\Generics\Exports\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:27
 *
 * Class DefaultService
 * @package App\Network\Modules\Manager\Generics\Exports\Factories\Services\Warehouse\Packing\Export
 */
class ExportService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeRepositoryInstance();
    }


}