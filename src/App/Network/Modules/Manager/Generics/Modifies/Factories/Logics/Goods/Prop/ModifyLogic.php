<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Prop;
use App\Entities\Bizdos\Goods\PropBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 13:33
 *
 * Class ModifyLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Prop
 */
class ModifyLogic extends AppLogic
{
    /**
     * @var PropBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(PropBaseDO::class, PropBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }
}