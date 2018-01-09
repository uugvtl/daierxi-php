<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account\Modify;
use App\Entities\Bizdos\Accounts\ManagerBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\ModifyLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 20:57
 *
 * Class DefaultLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account\Modify
 */
class AppLogic extends ModifyLogic
{
    /**
     * @var ManagerBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(ManagerBaseDO::class, $this->getBizBoClassString());
        $this->bizDo->init($rows)->setCache($store->getCache());;
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
        return ManagerBaseDO::class;
    }
}