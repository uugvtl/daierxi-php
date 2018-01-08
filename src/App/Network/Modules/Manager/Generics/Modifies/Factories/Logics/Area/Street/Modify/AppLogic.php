<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Area\Street\Modify;
use App\Entities\Bizdos\Area\StreetBaseDo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\ModifyLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 17:08
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Area\Street\Modify
 */
class AppLogic extends ModifyLogic
{
    /**
     * @var StreetBaseDo
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(StreetBaseDo::class, $this->getBizBoClassString());
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }

    /**
     * @return string
     */
    protected function getBizBoClassString()
    {
        return StreetBaseDo::class;
    }
}