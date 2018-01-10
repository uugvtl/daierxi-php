<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate;
use App\Network\Modules\Manager\Common\Factories\Logics\Goods\Cate\ModifyLogic;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 21:07
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate\Upload
 */
class UploadService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(NO);
        return parent::madeRepositoryInstance();
    }

    protected function getLogicClassString()
    {
        return ModifyLogic::class;
    }
}