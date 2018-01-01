<?php
namespace App\Helpers;
use App\Globals\Bases\BaseSingle;
use Exception;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/4/23
 * Time: 02:43
 */
class JsonHelper extends BaseSingle
{
    /**
     * Encodes an arbitrary variable into JSON format
     *
     * @param mixed $var any number, boolean, string, array, or object to be encoded.
     * If var is a string, it will be converted to UTF-8 format first before being encoded.
     * @return string JSON string representation of input var
     */
    public function encode($var)
    {
        return json_encode($var, JSON_UNESCAPED_SLASHES|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT);
    }

    /**
     * decodes a JSON string into appropriate variable
     *
     * @param string $str  JSON-formatted string
     * @param boolean $useArray  whether to use associative array to represent object data
     * @return mixed   number, boolean, string, array, or object corresponding to given JSON input string.
     *    Note that decode() always returns strings in ASCII or UTF-8 format!
     * @access   public
     */
    public function decode($str, $useArray=true)
    {
        return json_decode($str, $useArray);
    }

    /**
     * 获取异常消息
     * @param Exception $e
     * @return array
     */
    public function getExcp(Exception $e)
    {
        return $json = [
            'success'   =>false,
            'msg'       =>$e->getMessage(),
            'code'      =>$e->getCode()
        ];
    }

    /**
     * 发送异常消息到Client端
     * @param Exception $e           异常消息
     * @return void
     */
    public function sendExcp(Exception $e)
    {
        $json = $this->getExcp($e);
        echo $this->encode($json);
    }
}