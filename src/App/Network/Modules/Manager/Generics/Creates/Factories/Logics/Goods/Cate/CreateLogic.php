<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Cate;
use App\Entities\Bizdos\Goods\CateBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 23:45
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Cate\Create
 */
class CreateLogic extends AppLogic
{
    /**
     * @var CateBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $this->autoCommit(YES);
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(CateBaseDO::class, CateBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->insert()->isPersistent();
        $responder->toggle = $toggle;
    }

}