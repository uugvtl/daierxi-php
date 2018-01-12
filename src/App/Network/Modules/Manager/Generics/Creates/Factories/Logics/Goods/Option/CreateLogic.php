<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Option;
use App\Entities\Bizdos\Goods\OptionBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 19:36
 *
 * Class CreateLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Goods\Option
 */
class CreateLogic extends AppLogic
{
    /**
     * @var OptionBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $this->autoCommit(YES);
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(OptionBaseDO::class, OptionBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->insert()->isPersistent();
        $responder->toggle = $toggle;
    }

}