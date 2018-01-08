<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Area\Street\Create;
use App\Network\Legals\Area\StreetLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\CreateService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 16:21
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Area\Street\Create
 */
class AppService extends CreateService
{

    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(NO);
        return parent::madeRepositoryInstance();
    }

    protected function getLegalClassString()
    {
        return StreetLegal::class;
    }
}