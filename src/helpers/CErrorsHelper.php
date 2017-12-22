<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/17
 * Time: 15:09
 */
class CErrorsHelper extends CBaseHelper
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
}