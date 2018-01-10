<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Brand\Cate;
use App\Entities\Bizdos\Brand\CateBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 20:58
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Brand\Cate\Create
 */
class CreateLogic extends AppLogic
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
        $this->bizDo = $instanceHelper->build(CateBaseDO::class, $this->getBizBOClassString());
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
        return CateBaseDO::class;
    }
}