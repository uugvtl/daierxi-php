<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Account;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
use App\Network\Legals\Account\ManagerLegal;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 21:36
 *
 * Class CreateService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Account
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return ManagerLegal::class;
    }
}