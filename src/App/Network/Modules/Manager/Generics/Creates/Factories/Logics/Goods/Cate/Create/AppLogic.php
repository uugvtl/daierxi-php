<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Cate\Create;
use App\Entities\Bizdos\Goods\CateBaseDo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\CreateLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 23:45
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Cate\Create
 */
class AppLogic extends CreateLogic
{
    /**
     * @var CateBaseDo
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(CateBaseDo::class, $this->getBizBoClassString());
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
        return CateBaseDo::class;
    }
}