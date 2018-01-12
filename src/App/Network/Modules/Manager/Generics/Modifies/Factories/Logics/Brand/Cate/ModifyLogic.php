<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Brand\Cate;
use App\Entities\Bizdos\Brand\CateBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 01:40
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Brand\Cate\Modify
 */
class ModifyLogic extends AppLogic
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