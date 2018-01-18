<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\Rule;
use App\Globals\Sqlangs\BaseTable;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Common\Sqlangs\Permission\RuleTable;
use App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\AppRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 22:28
 *
 * Class MoRepository
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Repositories\Rule
 */
class MoRepository extends AppRepository
{
    protected function madeTableInstance()
    {
        $instanceHelper = InstanceHelper::getInstance();
        $fieldsInstance = $instanceHelper->build(BaseTable::class, RuleTable::class);
        return $fieldsInstance;
    }
}