<?php
namespace App\Helpers;
use App\Globals\Bases\BaseSingle;
use Phalcon\Http\Response\Cookies;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 13:52
 *
 * Class CCookiesHelper
 * @package App\Helpers
 */
class CookiesHelper extends BaseSingle
{
    /**
     * @var Cookies
     */
    private $cookies;

    public function setCookies(Cookies $cookies)
    {
        $this->cookies = $cookies;
        return $this;
    }

    /**
     * 获取框架保存的Cookie值
     * @param string $cookieName
     * @return array                    如果没有值的话返回空数组
     */
    public function getLoginCookie($cookieName)
    {
        $data = array();

        $cstringHelper  = StringHelper::getInstance();
        $jsonHelper     = JsonHelper::getInstance();

        $cryptString = $cstringHelper->cryptString($cookieName);

        if($this->cookies->has($cryptString))
        {
            $instance = $this->cookies->get($cryptString);
            $data = $jsonHelper->decode($cstringHelper->gzinflate($instance->getValue()));
        }
        return $data;
    }
}