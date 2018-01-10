<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services;
use App\Datasets\Consts\ClassConst;
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
        $this->getGenericInjecter()->useGeneralize(NO);
        return parent::madeRepositoryInstance();
    }

    protected function getLogicClassString()
    {
        $this->getGenericInjecter()->getDistributer()->setActString(ClassConst::MODIFY_PREFIX);
        return parent::getLogicClassString();
    }
}