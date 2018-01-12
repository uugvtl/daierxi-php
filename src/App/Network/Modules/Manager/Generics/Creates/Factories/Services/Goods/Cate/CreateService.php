<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Cate;
use App\Network\Legals\Goods\CateBaseLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 21:55
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Cate\Create
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return CateBaseLegal::class;
    }
}