<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\Index\Index;
use App\Globals\Sqlangs\BaseFields;
use App\Globals\Sqlangs\BaseTable;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Common\Sqlangs\Signin\AccountFields;
use App\Network\Modules\Manager\Common\Sqlangs\Signin\AccountTable;
use App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\QueryRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 23:37
 *
 * Class PrimaryRepository
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\Index\Index
 */
class DefaultRepository extends QueryRepository
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