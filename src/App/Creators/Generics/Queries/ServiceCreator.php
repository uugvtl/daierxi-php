<?php
namespace App\Creators\Generics\Queries;
use App\Creators\BaseCreator;
use App\Globals\Bases\Distributers\BaseService;
use App\Helpers\InstanceHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 01:09
 *
 * Class ServiceCreator
 * @package App\Creators\Generics\Queries
 */
class ServiceCreator extends BaseCreator
{
    public function create($classname, ...$args)
    {
        $instanceHelper = InstanceHelper::getInstance();
        $service = $instanceHelper->build(BaseService::class, $classname);

        return $service->init($args)->setGenericInjecter($this->genericInjecter);
    }
}