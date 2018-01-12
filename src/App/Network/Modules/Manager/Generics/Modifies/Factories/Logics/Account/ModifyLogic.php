<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
use App\Entities\Bizdos\Accounts\ManagerBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 21:40
 *
 * Class ModifyLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account
 */
class ModifyLogic  extends AppLogic
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
        $this->bizDo = $instanceHelper->build(ManagerBaseDO::class, ManagerBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());;
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }

}