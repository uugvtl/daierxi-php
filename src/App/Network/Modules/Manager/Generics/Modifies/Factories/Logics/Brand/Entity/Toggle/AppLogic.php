<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Brand\Entity\Toggle;
use App\Globals\Bizes\BaseDisabledDo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\ModifyLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 17:51
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Brand\Entity\Toggle
 */
class AppLogic extends ModifyLogic
{
    /**
     * @var BaseDisabledDo
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(BaseDisabledDo::class, $this->getBizBoClassString());
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }
}