<?php
namespace App\Network\Modules\Manager\Generics\Queries;
use App\Creators\BaseCreator;
use App\Creators\Generics\Queries\ServiceCreator;
use App\Globals\Bases\Generics\BaseContainer;
use App\Network\Modules\Manager\Generics\Queries\Services\QueryService;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 12:43
 *
 * Class QueryContainer
 * @package App\Network\Modules\Manager\Generics\Queries
 */
class QueryContainer extends BaseContainer
{
    /**
     * @var BaseCreator
     */
    private $serviceCreator;

    public function run()
    {
        $this->serviceCreator = ServiceCreator::getInstance();
        $this->serviceCreator->init($this->getGenericInjecter());
        $service = $this->serviceCreator->create(QueryService::class);
        $service->run();
    }
}