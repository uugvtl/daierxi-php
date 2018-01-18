<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Services\Rule;
use App\Network\Modules\Manager\Generics\Queries\Factories\Services\AppService;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 18/1/18
 * Time: 20:25
 *
 * Class MenuService
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Services\Rule
 */
class MenuService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeRepositoryInstance();
    }

}