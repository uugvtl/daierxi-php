<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Brand\Entity\Upload;
use App\Entities\Bizdos\Brand\EntityBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\ModifyLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:52
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Brand\Entity\Upload
 */
class AppLogic extends ModifyLogic
{
    /**
     * @var EntityBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(EntityBaseDO::class, $this->getBizDoClassString());
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
    protected function getBizDoClassString()
    {
        return EntityBaseDO::class;
    }
}