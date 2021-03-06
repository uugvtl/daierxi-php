<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Index;
use App\Datasets\ExcpCode;
use App\Entities\Bizbos\Signin\AccountBaseBO;
use App\Globals\Finals\Responder;
use App\Globals\Traits\AccountTrait;
use App\Helpers\InstanceHelper;
use App\Helpers\JsonHelper;
use App\Helpers\StringHelper;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\AppLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 17:43
 *
 * Class IndexLogic
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Logics\Index
 */
class IndexLogic extends AppLogic
{

    use AccountTrait;

    public function get()
    {
        $this->beforeBegin();
        $responder = Responder::getInstance();
        $this->run($responder);
        $this->afterEnd();
        return $responder;
    }

    protected function run(Responder $responder)
    {
        $sqlangInjecter = $this->getRepositpry()->get();
        $store = $this->getStore();
        $rows = $store->setSqlangInjecter($sqlangInjecter)->getRow();

        if($rows)
        {
            $instanceHelper = InstanceHelper::getInstance();
            $accountBo = $instanceHelper->build(AccountBaseBO::class, AccountBaseBO::class);
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

        $this->cookies->set($cookieName, $json, $expire, '/',false);
        setcookie('manager_name', urlencode($accountBo->account_name), $expire, '/');
        setcookie('manager_id', $accountBo->account_id, $expire, '/'); // 如果 跨域需要设置 SESSION_COOKIE_DOMAIN
        setcookie('language', 'zh', $expire, '/'); // 如果 跨域需要设置 SESSION_COOKIE_DOMAIN
    }
}