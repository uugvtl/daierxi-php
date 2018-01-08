<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account\Group;
use App\Entities\Bizdos\Accounts\ManagerBaseDo;
use App\Globals\Finals\Responder;
use App\Globals\Traits\PersistentTait;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\ModifyLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 12:33
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Account\Group
 */
class AppLogic extends ModifyLogic
{
    /**
     * @var ManagerBaseDo[]
     */
    private $bizDos;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();

        $grants = explode(',', $rows['grant']);
        $group_id = $rows['group_id'];
        if(is_array($grants))
        {
            foreach ($grants as $manager_id)
            {
                $arguments = [
                    'group_id'  =>$group_id,
                    'manager_id'=>$manager_id
                ];
                $bizDo = $instanceHelper->build(ManagerBaseDo::class, $this->getBizBoClassString());
                $bizDo->init($arguments)->setCache($store->getCache());
                $this->bizDos[] = $bizDo;
            }
        }
    }

    protected function run(Responder $responder)
    {

        if (is_array($this->bizDos))
        {
            $toggles = [];

            foreach ($this->bizDos as $bizDo)
            {
                $toggles[] = $bizDo->submit()->isPersistent();
            }

            $responder->toggle = $this->batchPersistent($toggles);
        }

    }

    /**
     * @return string
     */
    protected function getBizBoClassString()
    {
        return ManagerBaseDo::class;
    }


    use PersistentTait;
}