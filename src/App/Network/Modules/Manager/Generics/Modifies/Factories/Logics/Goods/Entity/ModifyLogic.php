<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Entity;
use App\Entities\Bizdos\Goods\EntityBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 17:04
 *
 * Class ModifyLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Entity
 */
class ModifyLogic extends AppLogic
{
    /**
     * @var EntityBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(EntityBaseDO::class, EntityBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }

}