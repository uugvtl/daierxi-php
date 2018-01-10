<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 21:07
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate\Upload
 */
class UploadService extends ModifyService
{
    protected function getLogicClassString()
    {
        $this->getGenericInjecter()->getDistributer()->setActString('Modify');
        return parent::getLogicClassString();
    }
}