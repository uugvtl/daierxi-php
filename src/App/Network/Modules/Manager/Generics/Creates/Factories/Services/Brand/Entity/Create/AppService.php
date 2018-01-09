<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Brand\Entity\Create;
use App\Network\Legals\Brand\EntityLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\CreateService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:29
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Brand\Entity\Create
 */
class AppService extends CreateService
{
    protected function getLegalClassString()
    {
        return EntityLegal::class;
    }
}