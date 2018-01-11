<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Index;
use App\Datasets\ExcpCode;
use App\Entities\Bizbos\Signin\AccountBaseBO;
use App\Globals\Finals\Responder;
use App\Globals\Traits\AccountTrait;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Queries\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 21:55
 *
 * Class CookieLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Index\Index
 */
class IndexLogic extends AppLogic
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
            $accountBo = $instanceHelper->build(AccountBaseBO::class, $this->getBizBOClassString());
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
    protected function getBizBOClassString()
    {
        return AccountBaseBO::class;
    }

}