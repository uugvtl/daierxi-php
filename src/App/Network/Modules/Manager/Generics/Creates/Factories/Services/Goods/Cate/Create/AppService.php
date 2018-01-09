<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Cate\Create;
use App\Network\Legals\Goods\CateLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\CreateService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 21:55
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Cate\Create
 */
class AppService extends CreateService
{
    protected function getLegalClassString()
    {
        return CateLegal::class;
    }
}