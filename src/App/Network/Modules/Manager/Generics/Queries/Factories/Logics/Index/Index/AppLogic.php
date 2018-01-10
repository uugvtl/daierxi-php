<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Index\Index;
use App\Datasets\ExcpCode;
use App\Entities\Bizbos\Signin\AccountBaseBO;
use App\Globals\Finals\Responder;
use App\Globals\Traits\AccountTrait;
use App\Helpers\InstanceHelper;
use App\Helpers\JsonHelper;
use App\Helpers\StringHelper;
use App\Network\Modules\Manager\Generics\Queries\Factories\Logics\QueryLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 23:29
 *
 * Class PrimaryLogic
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Index\Index
 */
class AppLogic extends QueryLogic
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
                $this->sendCookies($accountBo);
            }
            else
            {
                $responder->toggle = NO;
                $responder->msg = $this->t('errors', 'disabled_login');
                $responder->code = ExcpCode::DISABLED_LOGIN;
            }
        }
        else
        {
            $responder->toggle = NO;
            $responder->msg = $this->t('errors', 'invalid_login');
            $responder->code = ExcpCode::INVALID_LOGIN;
        }



    }


    /**
     * @return string
     */
    protected function getBizBOClassString()
    {
        return AccountBaseBO::class;
    }

    /**
     * 发送cookie到浏览器
     * @param AccountBaseBO $accountBo
     */
    private function sendCookies(AccountBaseBO $accountBo)
    {
        $stringHelper = StringHelper::getInstance();
        $jsonHelper = JsonHelper::getInstance();

        $cookieName = $stringHelper->cryptString(LOGIN_MANAGER);

        $expire = time() + 15 * 86400;
        $json = $jsonHelper->encode(['manager_id'=>$accountBo->account_id]);
        $json = $stringHelper->gzdeflate($json);

        $this->cookies->set($cookieName, $json, $expire, '/',false, SESSION_COOKIE_DOMAIN);
        setcookie('manager_name', urlencode($accountBo->account_name), $expire, '/', SESSION_COOKIE_DOMAIN);
        setcookie('manager_id', $accountBo->account_id, $expire, '/', SESSION_COOKIE_DOMAIN);
    }

}