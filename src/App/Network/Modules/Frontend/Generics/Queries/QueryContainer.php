<?php
namespace App\Network\Modules\Frontend\Generics\Queries;
use App\Helpers\InstanceHelper;
use App\Network\Generics\GenericContainer;
use App\Network\Modules\Frontend\Generics\Queries\Services\QueryService;
use const BACKSLASH;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 12:43
 *
 * Class QueryContainer
 * @package App\Network\Modules\Frontend\Generics\Queries
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

        $genericInjecter = $this->getCloneGenericInjecter();

        if($genericInjecter->hasGeneralize())
        {
            $package = $genericInjecter->getPackage();
            $path = $genericInjecter->getDistributer()->getPath();

            $classname = $package.BACKSLASH.'Services'.BACKSLASH.$path.'Service';

            $service = $instanceHelper->build(QueryService::class, $classname);
        }
        else
        {

            $service = $instanceHelper->build(QueryService::class, QueryService::class);
        }

        return $service->setGenericInjecter($genericInjecter);
    }
}