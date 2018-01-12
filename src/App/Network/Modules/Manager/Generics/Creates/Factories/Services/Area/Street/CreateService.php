<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Area\Street;
use App\Network\Legals\Area\StreetBaseLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 16:21
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Area\Street\Create
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return StreetBaseLegal::class;
    }
}