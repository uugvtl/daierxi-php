<?php
namespace App\Network\Modules\Manager\Generics\Exports\Factories\Services\Warehouse\Packing\Export;
use App\Network\Modules\Manager\Generics\Exports\Factories\Services\ExportService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:27
 *
 * Class DefaultService
 * @package App\Network\Modules\Manager\Generics\Exports\Factories\Services\Warehouse\Packing\Export
 */
class AppService extends ExportService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::madeRepositoryInstance();
    }

    protected function madeLogicInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::madeLogicInstance();
    }
}