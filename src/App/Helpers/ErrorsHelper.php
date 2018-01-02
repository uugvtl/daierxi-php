<?php
namespace App\Helpers;
use App\Globals\Bases\BaseSingle;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/17
 * Time: 15:09
 */
class ErrorsHelper extends BaseSingle
{
    /**
     * 格式化异常信息
     * @param string $traceMsg      错误追踪信息
     * @return string               格式化后的追踪信息
     */
    public function formatExceptionTrace($traceMsg)
    {
        return str_replace("\n", "<br>\n", $traceMsg);
    }

    /**
     * 手动触发一个错误
     * @param $errormsg
     * @return void
     */
    public function triggerError($errormsg)
    {
        trigger_error($errormsg, E_USER_ERROR);
    }
}