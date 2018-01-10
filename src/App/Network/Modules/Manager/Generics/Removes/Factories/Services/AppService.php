<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Services;
use App\Network\Generics\Removes\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 21:47
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Services
 */
class AppService extends GenericService
{

    protected function madeLogicInstance()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::madeLogicInstance();
    }
}