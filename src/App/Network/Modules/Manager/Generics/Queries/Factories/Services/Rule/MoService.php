<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Services\Rule;
use App\Network\Modules\Manager\Generics\Queries\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 22:24
 *
 * Class MoService
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Services\Rule
 */
class MoService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeRepositoryInstance();
    }

}