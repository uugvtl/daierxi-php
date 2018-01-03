<?php
namespace App\Network\Modules\Manager\Generics\Queries\Logics\Index\Index;
use App\Entities\Bizbos\Signin\AccountBo;
use App\Globals\Finals\Responder;
use App\Helpers\InstanceHelper;
use App\Helpers\JsonHelper;
use App\Helpers\StringHelper;
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

        if($rows)
        {
            $responder->msg = $this->t('errors', 'disabled_login');
            $responder->code = 40001;
        }
        else
        {
            $instanceHelper = InstanceHelper::getInstance();
            $accountBo = $instanceHelper->build(AccountBo::class, $this->getBizBoClassString());
            $accountBo->init($rows);

            if($accountBo->enabled)
            {
                $responder->toggle = YES;
                $this->sendCookies($accountBo);
            }
            else
            {
                $responder->msg = $this->t('errors', 'invalid_login');
                $responder->code = 40002;
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

        setcookie($cookieName, $json, $expire, '/', SESSION_COOKIE_DOMAIN);
        setcookie('manager_name', urlencode($accountBo->account_name), $expire, '/', SESSION_COOKIE_DOMAIN);
        setcookie('manager_id', $accountBo->account_id, $expire, '/', SESSION_COOKIE_DOMAIN);
    }

}