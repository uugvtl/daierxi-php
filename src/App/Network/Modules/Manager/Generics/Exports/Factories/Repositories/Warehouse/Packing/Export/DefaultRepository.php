<?php
namespace App\Network\Modules\Manager\Generics\Exports\Factories\Repositories\Warehouse\Packing\Export;
use App\Globals\Sqlangs\BaseFields;
use App\Globals\Sqlangs\BaseTable;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Common\Sqlangs\Warehouse\PackingFields;
use App\Network\Modules\Manager\Common\Sqlangs\Warehouse\PackingTable;
use App\Network\Modules\Manager\Common\Sqlangs\Warehouse\PackingWhere;
use App\Network\Modules\Manager\Generics\Exports\Factories\Repositories\ExportRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:32
 *
 * Class DefaultRepository
 * @package App\Network\Modules\Manager\Generics\Exports\Factories\Repositories\Warehouse\Packing\Export
 */
class DefaultRepository extends ExportRepository
{
    protected function createFieldsInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();
        $fieldsInstance = $instanceHelper->build(BaseFields::class, PackingFields::class);
        return $fieldsInstance;

    }

    protected function createTableInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();
        $fieldsInstance = $instanceHelper->build(BaseTable::class, PackingTable::class);
        return $fieldsInstance;
    }

    protected function createWhereInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();
        $fieldsInstance = $instanceHelper->build(BaseWhere::class, PackingWhere::class);
        return $fieldsInstance;
    }


}