<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Services\Index\Index;
use App\Network\Modules\Manager\Generics\Queries\Factories\Services\QueryService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 21:35
 *
 * Class CookieService
 * @package App\Network\Modules\Manager\Generics\Factories\Queries\Services\Index\Index
 */
class CookieService extends QueryService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeRepositoryInstance();
    }

    protected function madeLogicInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeLogicInstance();
    }
}