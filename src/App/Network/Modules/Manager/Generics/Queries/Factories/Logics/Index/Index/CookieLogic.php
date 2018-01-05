<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Index\Index;
use App\Datasets\ExcpCode;
use App\Entities\Bizbos\Signin\AccountBaseBo;
use App\Globals\Finals\Responder;
use App\Globals\Traits\AccountTrait;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Queries\Factories\Logics\QueryLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 21:55
 *
 * Class CookieLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Index\Index
 */
class CookieLogic extends QueryLogic
{
    use AccountTrait;

    protected function run(Responder $responder)
    {
        $sqlangInjecter = $this->getRepositpry()->get();
        $store = $this->getStore();
        $rows = $store->setSqlangInjecter($sqlangInjecter)->getRow();

        if($rows)
        {
            $instanceHelper = InstanceHelper::getInstance();
            $accountBo = $instanceHelper->build(AccountBaseBo::class, $this->getBizBoClassString());
            $accountBo->init($rows);

            if($accountBo->enabled)
            {
                $responder->toggle = YES;
                $this->initAccountShare($this->getDI(), $accountBo);
            }
            else
            {
                $responder->toggle = NO;
                $responder->msg = $this->t('errors', 'disabled_login');
                $responder->code = ExcpCode::DISABLED_LOGIN;
            }
        }
    }


    /**
     * @return string
     */
    protected function getBizBoClassString()
    {
        return AccountBaseBo::class;
    }

}