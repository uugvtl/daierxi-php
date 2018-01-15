<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Recipe;
use App\Entities\Bizdos\Goods\RecipeBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 14:58
 *
 * Class ModifyLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Recipe
 */
class ModifyLogic  extends AppLogic
{
    /**
     * @var RecipeBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(RecipeBaseDO::class, RecipeBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }
}