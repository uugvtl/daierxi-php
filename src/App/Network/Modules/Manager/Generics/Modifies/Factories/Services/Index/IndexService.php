<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Index;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 17:49
 *
 * Class IndexService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Index
 */
class IndexService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeRepositoryInstance();
    }

}