<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services;
use App\Network\Generics\Modifies\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 20:16
 *
 * Class ModifyService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services
 */
class AppService extends GenericService
{

    protected function madeLogicInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::madeLogicInstance();
    }
}