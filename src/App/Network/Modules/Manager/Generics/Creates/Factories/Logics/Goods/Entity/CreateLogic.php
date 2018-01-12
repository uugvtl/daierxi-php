<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Entity;
use App\Entities\Bizdos\Goods\EntityBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 16:37
 *
 * Class CreateLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Entity
 */
class CreateLogic extends AppLogic
{
    /**
     * @var EntityBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $this->autoCommit(YES);
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(EntityBaseDO::class, $this->getBizBOClassString());
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->insert()->isPersistent();
        $responder->toggle = $toggle;
    }

    /**
     * @return string
     */
    protected function getBizBOClassString()
    {
        return EntityBaseDO::class;
    }
}