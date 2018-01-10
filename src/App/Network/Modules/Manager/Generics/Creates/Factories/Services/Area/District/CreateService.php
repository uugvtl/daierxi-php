<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Area\District;
use App\Network\Legals\Area\DistrictLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 01:22
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Area\District\Create
 */
class CreateService extends AppService
{

    protected function getLegalClassString()
    {
        return DistrictLegal::class;
    }
}