<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Account\Create;
use App\Entities\Bizdos\Accounts\ManagerBaseDo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\CreateLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 01:25
 *
 * Class DefaultLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Account\Create
 */
class DefaultLogic extends CreateLogic
{
    /**
     * @var ManagerBaseDo
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(ManagerBaseDo::class, $this->getBizBoClassString());
        $this->bizDo->init($rows)->setCache($store->getCache());;
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->insert()->isPersistent();
        $responder->toggle = $toggle;
    }

    /**
     * @return string
     */
    protected function getBizBoClassString()
    {
        return ManagerBaseDo::class;
    }
}