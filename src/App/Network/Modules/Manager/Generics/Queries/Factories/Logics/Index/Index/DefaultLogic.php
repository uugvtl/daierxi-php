<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Logics\Index\Index;
use App\Datasets\ExcpCode;
use App\Entities\Bizbos\Signin\AccountBo;
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
class DefaultLogic extends QueryLogic
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
                $this->sendCookies($accountBo);
            }
            else
            {
                $responder->msg = $this->t('errors', 'disabled_login');
                $responder->code = ExcpCode::DISABLED_LOGIN;
            }
        }
        else
        {
            $responder->msg = $this->t('errors', 'invalid_login');
            $responder->code = ExcpCode::INVALID_LOGIN;
        }



    }


    /**
     * @return string
     */
    protected function getBizBoClassString()
    {
        return AccountBo::class;
    }

    /**
     * 发送cookie到浏览器
     * @param AccountBo $accountBo
     */
    private function sendCookies(AccountBo $accountBo)
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