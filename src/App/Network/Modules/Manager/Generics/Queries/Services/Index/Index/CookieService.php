<?php
namespace App\Network\Modules\Manager\Generics\Queries\Services\Index\Index;
use App\Network\Modules\Manager\Generics\Queries\Services\QueryService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 21:35
 *
 * Class CookieService
 * @package App\Network\Modules\Manager\Generics\Queries\Services\Index\Index
 */
class CookieService extends QueryService
{
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