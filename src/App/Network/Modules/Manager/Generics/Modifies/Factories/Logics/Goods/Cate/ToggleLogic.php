<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Cate;
use App\Globals\Bizes\BaseDisabledDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 22:34
 *
 * Class ToggleLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Goods\Cate
 */
class ToggleLogic extends AppLogic
{
    /**
     * @var BaseDisabledDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(BaseDisabledDO::class, $this->getBizDOClassString());
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }
}