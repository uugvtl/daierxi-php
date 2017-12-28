<?php
namespace App\Network\Generics;
use App\Globals\Bases\BaseGeneric;
use App\Interfaces\IRunnable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:55
 *
 * Class GenericContainer
 * @package App\Network\Modules\Manager\Generics
 */
abstract class GenericContainer extends BaseGeneric implements IRunnable
{

    protected function createService()
    {
        $this->getGenericInjecter();

//        $this->serviceCreator = ServiceCreator::getInstance();
//        $this->serviceCreator->init($this->getGenericInjecter());
//        $service = $this->serviceCreator->create(QueryService::class);
//        $service->run();
    }
}