<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Account\Create;
use App\Network\Legals\Account\ManagerLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\CreateService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 01:12
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Account\Create
 */
class AppService extends CreateService
{
    protected function getLegalClassString()
    {
        return ManagerLegal::class;
    }
}