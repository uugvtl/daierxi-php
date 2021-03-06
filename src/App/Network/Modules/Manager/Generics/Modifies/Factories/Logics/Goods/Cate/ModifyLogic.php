<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Cate;
use App\Entities\Bizdos\Goods\CateBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Generics\Modifies\GenericLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 22:55
 *
 * Class ModifyLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Cate
 */
class ModifyLogic extends GenericLogic
{
    /**
     * @var CateBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(CateBaseDO::class, CateBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }

}