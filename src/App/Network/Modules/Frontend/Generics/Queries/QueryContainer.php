<?php
namespace App\Network\Modules\Frontend\Generics\Queries;
use App\Globals\Finals\Responder;
use App\Network\Generics\GenericContainer;

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
//    /**
//     * @var QueryFactory
//     */
//    protected $serviceFactory;

    public function run()
    {

        return Responder::getInstance();
//        $this->serviceFactory = $this->getSpread()?
//            QueryFactory::getFactory(PackageConst::PACKAGE, $this->getSpread()):
//            QueryFactory::getFactory(PackageConst::PACKAGE);
//        $this->getSpread() || $this->serviceFactory->setBaseClass('QueryService');
//
//        $service = $this->serviceFactory->createInstance($this->distributer);
//        return $service->launch();
    }
}