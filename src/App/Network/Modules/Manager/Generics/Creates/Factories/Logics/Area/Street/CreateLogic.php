<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Area\Street;
use App\Entities\Bizdos\Area\StreetBaseDO;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Creates\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 16:23
 *
 * Class AppLogic
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Logics\Area\Street\Create
 */
class CreateLogic extends AppLogic
{
    /**
     * @var StreetBaseDO
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $this->autoCommit(YES);
        $store = $this->getStore();
        $rows = $this->getGenericInjecter()->getParameter()->get();
        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(StreetBaseDO::class, StreetBaseDO::class);
        $this->bizDo->init($rows)->setCache($store->getCache());
    }

    protected function run(Responder $responder)
    {
        $toggle = $this->bizDo->insert()->isPersistent();
        $responder->toggle = $toggle;
    }

}