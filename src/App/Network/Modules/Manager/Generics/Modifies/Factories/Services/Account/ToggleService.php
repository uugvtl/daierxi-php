<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Account;
use App\Globals\Legals\EnabledLegal;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 21:53
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Account\Toggle
 */
class ToggleService extends AppService
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