<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Recipe;
use App\Network\Legals\Goods\RecipeBaseLegal;
use App\Network\Modules\Manager\Generics\Creates\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 13:49
 *
 * Class CreateService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services\Goods\Recipe
 */
class CreateService extends AppService
{
    protected function getLegalClassString()
    {
        return RecipeBaseLegal::class;
    }
}