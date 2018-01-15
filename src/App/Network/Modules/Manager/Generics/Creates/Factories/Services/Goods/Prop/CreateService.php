<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Prop;
use App\Network\Legals\Goods\PropBaseLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 12:45
 *
 * Class CreateService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Prop
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return PropBaseLegal::class;
    }
}