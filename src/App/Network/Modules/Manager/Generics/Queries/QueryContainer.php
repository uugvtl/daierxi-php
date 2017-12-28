<?php
namespace App\Network\Modules\Manager\Generics\Queries;
use App\Helpers\InstanceHelper;
use App\Network\Generics\GenericContainer;
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
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getGenericInjecter()->getClone();

        if($genericInjecter->hasGeneralize())
        {
            $package = $genericInjecter->getPackage();
            $path = $genericInjecter->getDistributer()->getPath();

            $classname = $package.BACKSLASH.$path;

            $service = $instanceHelper->build(QueryService::class, $classname);
        }
        else
        {

            $service = $instanceHelper->build(QueryService::class, QueryService::class);
        }

        return $service->setGenericInjecter($genericInjecter);
    }
}