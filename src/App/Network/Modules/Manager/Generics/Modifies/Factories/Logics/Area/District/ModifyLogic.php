<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Area\District;
use App\Entities\Bizdos\Area\DistrictBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 14:30
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Area\District\Modify
 */
class ModifyLogic extends AppLogic
{
    /**
     * @var DistrictBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $this->autoCommit(YES);
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(DistrictBaseDO::class, DistrictBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        $responder->toggle = $toggle;
    }

}