<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 20:54
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate\Modify
 */
class ModifyService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(NO);
        return parent::madeRepositoryInstance();
    }
}