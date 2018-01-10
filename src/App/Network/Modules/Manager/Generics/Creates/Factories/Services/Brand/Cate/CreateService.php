<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Brand\Cate;
use App\Network\Legals\Brand\CateLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 20:34
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Brand\Cate\Create
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return CateLegal::class;
    }
}