<?php
namespace App\Network\Modules\Manager\Generics\Queries;
use App\Helpers\InstanceHelper;
use App\Network\Generics\Queries\GenericContainer;
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
class QueryContainer extends GenericContainer
{

    public function run()
    {
        $service = $this->createService();
        return $service->run();

    }

    /**
     * @return QueryService
     */
    protected function createService()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('QueryService');
        $servicename = $this->getServiceClassString();

        $instanceHelper = InstanceHelper::getInstance();

        $serviceInstance = $instanceHelper->build(QueryService::class, $servicename);
        $serviceInstance->setGenericInjecter($cloneGenericInjecter);

        return $serviceInstance;

    }
}