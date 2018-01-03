<?php
namespace App\Network\Modules\Manager\Generics\Queries\Services\Index\Index;
use App\Network\Modules\Manager\Generics\Queries\Services\QueryService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 22:59
 *
 * Class PrimaryService
 * @package App\Network\Modules\Manager\Generics\Queries\Services\Index\Index
 */
class DefaultService extends QueryService
{
    public function get()
    {

        $repository = $this->createRepositoryInstance();
        $logic = $this->createLogicInstance();
        return $logic->init($repository)->get();
    }

    protected function createRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::createRepositoryInstance();
    }

    protected function createLogicInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::createLogicInstance();
    }
}