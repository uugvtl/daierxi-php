<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Brand\Entity\Create;
use App\Entities\Bizdos\Brand\EntityBaseDo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\CreateLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:34
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Brand\Entity\Create
 */
class AppLogic extends CreateLogic
{
    /**
     * @var EntityBaseDo
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(EntityBaseDo::class, $this->getBizBoClassString());
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
    protected function getBizBoClassString()
    {
        return EntityBaseDo::class;
    }
}