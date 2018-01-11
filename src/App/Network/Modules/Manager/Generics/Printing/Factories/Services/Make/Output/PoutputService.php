<?php
namespace App\Network\Modules\Manager\Generics\Printing\Factories\Services\Make\Output;
use App\Network\Modules\Manager\Generics\Printing\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 17:57
 *
 * Class DefaultService
 * @package App\Network\Modules\Manager\Generics\Printing\Factories\Services\Make\Output\Poutput
 */
class PoutputService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->useGeneralize(NO);
        return parent::madeRepositoryInstance();
    }

    protected function madeLogicInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeLogicInstance();
    }
}