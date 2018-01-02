<?php
namespace App\Network\Modules\Manager\Generics\Queries\Logics\Index\Index;
use App\Entities\Bizbos\Signin\AccountBo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Queries\Logics\QueryLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 23:29
 *
 * Class PrimaryLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Logics\Index\Index
 */
class PrimaryLogic extends QueryLogic
{
    protected function run(Responder $responder)
    {
        $store = $this->getRepositpry()->get();
        $rows = $store->getRow();

        $instanceHelper = InstanceHelper::getInstance();
        $accountBo = $instanceHelper->build(AccountBo::class, $this->getBizBoClassString());
        $accountBo->init($rows);
        
    }


    /**
     * @return string
     */
    protected function getBizBoClassString()
    {
        return AccountBo::class;
    }


}