<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account;
use App\Globals\Bizes\BaseEnabledDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 22:01
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account\Toggle
 */
class ToggleLogic extends AppLogic
{
    /**
     * @var BaseEnabledDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(BaseEnabledDO::class, $this->getBizDOClassString());
        $this->bizDo->init($rows)->setCache($store->getCache());;
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }
}