<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Brand\Entity;
use App\Datasets\Consts\DataConst;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 23:01
 *
 * Class UploadService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Brand\Entity
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
        $this->getGenericInjecter()->getDistributer()->setActString(DataConst::MODIFY_PREFIX);
        return parent::getLogicClassString();
    }
}