<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Option;
use App\Network\Legals\Goods\OptionBaseLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 19:11
 *
 * Class CreateService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Option
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return OptionBaseLegal::class;
    }
}