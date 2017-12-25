<?php
namespace App\Helpers;
class RegexHelper extends BaseHelper
{
    /**
     * 获取中国大陆手机号码的验证规则
     * @return string               中国大陆手机号码正则
     */
    public function getChinaMobileRule()
    {
        return '/^1[3|4|5|7|8][0-9]\d{4,8}$/';
    }

    /**
     * 获取QQ正则
     * @return string               QQ正则
     */
    public function getQQRule()
    {
        return '/^[1-9][0-9]{4,8}$/';
    }

    /**
     * 获取中国邮政编码正则
     * @return string               中国邮政编码正则
     */
    public function getZipRule()
    {
        return '/^[0-9][0-9]{5}$/';
    }

    /**
     * 获取中国大陆固定电话正则
     * @return string               中国大陆固定电话正则
     */
    public function getPhoneRule()
    {
        return '/^(([0-9]{2,3})|([0-9]{3}-))?((0[0-9]{2,3})|0[0-9]{2,3}-)?[1-9][0-9]{6,7}(-[0-9]{1,4})?$/';
    }
}