<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Repositories\Index;
use App\Globals\Sqlangs\BaseFields;
use App\Globals\Sqlangs\BaseTable;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Repositories\AppRepository;
use App\Network\Modules\Manager\Common\Sqlangs\Signin\AccountFields;
use App\Network\Modules\Manager\Common\Sqlangs\Signin\AccountTable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 17:50
 *
 * Class IndexRepository
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Repositories\Index
 */
class IndexRepository extends AppRepository
{
    protected function madeFieldsInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();
        $fieldsInstance = $instanceHelper->build(BaseFields::class, AccountFields::class);
        return $fieldsInstance;

    }

    protected function madeTableInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();
        $fieldsInstance = $instanceHelper->build(BaseTable::class, AccountTable::class);
        return $fieldsInstance;
    }
}