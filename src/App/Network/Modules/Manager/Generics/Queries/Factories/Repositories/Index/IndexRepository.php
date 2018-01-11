<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\Index;
use App\Globals\Sqlangs\BaseFields;
use App\Globals\Sqlangs\BaseTable;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Common\Sqlangs\Signin\AccountFields;
use App\Network\Modules\Manager\Common\Sqlangs\Signin\AccountTable;
use App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\AppRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 21:53
 *
 * Class CookieRepository
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\Index\Index
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