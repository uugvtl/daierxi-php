<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Recipe;
use App\Network\Legals\Goods\RecipeBaseLegal;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 14:56
 *
 * Class ModifyService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Recipe
 */
class ModifyService extends AppService
{
    protected function getLegalClassString()
    {
        return RecipeBaseLegal::class;
    }

    protected function madeRepositoryInstance()
    {
        $this->useGeneralize(NO);
        return parent::madeRepositoryInstance();
    }
}