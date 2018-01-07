<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Account\Toggle;
use App\Globals\Legals\EnabledLegal;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\ModifyService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 21:53
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Account\Toggle
 */
class AppService extends ModifyService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(NO);
        return parent::madeRepositoryInstance();
    }

    protected function getLegalClassString()
    {
        return EnabledLegal::class;
    }
}