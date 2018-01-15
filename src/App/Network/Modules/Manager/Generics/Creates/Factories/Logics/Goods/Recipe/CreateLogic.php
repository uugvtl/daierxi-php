<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Recipe;
use App\Entities\Bizdos\Goods\RecipeBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 14:15
 *
 * Class CreateLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Recipe
 */
class CreateLogic extends AppLogic
{
    /**
     * @var RecipeBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $this->autoCommit(YES);
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(RecipeBaseDO::class, RecipeBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->insert()->isPersistent();
        $responder->toggle = $toggle;
    }
}