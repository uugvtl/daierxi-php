<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services;
use App\Datasets\Consts\DataConst;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 23:28
 *
 * Class UploadService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services
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