<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Brand\Entity;
use App\Network\Legals\Brand\EntityBaseLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:29
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Brand\Entity\Create
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return EntityBaseLegal::class;
    }
}