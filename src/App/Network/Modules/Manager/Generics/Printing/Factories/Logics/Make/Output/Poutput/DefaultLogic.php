<?php
namespace App\Network\Modules\Manager\Generics\Printing\Factories\Logics\Make\Output\Poutput;
use App\Entities\Bizdos\Make\OutputBaseDo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Printing\Factories\Logics\PrintLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 18:15
 *
 * Class DefaultLogic
 * @package App\Network\Modules\Manager\Generics\Printing\Factories\Logics\Make\Output\Poutput
 */
class DefaultLogic extends PrintLogic
{

    protected function commit()
    {
        $store = $this->getStore();
        $sqlangInjecter = $this->getRepositpry()->get();

        $rows = $store->setSqlangInjecter($sqlangInjecter)->getRow();
        $classString = $this->getBizDoClassString();

        $instanceHelper = InstanceHelper::getInstance();
        $bizDo = $instanceHelper->build(OutputBaseDo::class, $classString);
        $bizDo->init($rows)->initStatusBo();

        $toggle = $bizDo->setCache($store->getCache())->submit()->isPersistent();

        return $toggle;
    }

    protected function run(Responder $responder)
    {
//        $this->getRepositpry()->getGenericInjecter()->getDistributer()->setPrefixString('Complex');
//        $sqlangInjecter = $this->getRepositpry()->get();
//        $store->setSqlangInjecter($sqlangInjecter)->getList();

        $responder->toggle = YES;
        $responder->adapter = $this->getAdapter();
    }
}