<?php
namespace App\Network\Modules\Manager\Generics\Queries\Logics\Index\Index;
use App\Entities\Bizbos\Signin\AccountBo;
use App\Globals\Finals\Responder;
use App\Globals\Traits\AccountTrait;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Queries\Logics\QueryLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 21:55
 *
 * Class CookieLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Logics\Index\Index
 */
class CookieLogic extends QueryLogic
{
    use AccountTrait;

    protected function run(Responder $responder)
    {
        $store = $this->getRepositpry()->get();
        $rows = $store->getRow();

        if($rows)
        {
            $instanceHelper = InstanceHelper::getInstance();
            $accountBo = $instanceHelper->build(AccountBo::class, $this->getBizBoClassString());
            $accountBo->init($rows);

            if($accountBo->enabled)
            {
                $responder->toggle = YES;
                $this->initAccountShare($this->getDI(), $accountBo);
            }
        }
    }


    /**
     * @return string
     */
    protected function getBizBoClassString()
    {
        return AccountBo::class;
    }

}