<?php
namespace App\Libraries;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 14:26
 *
 * Class Creator
 * @package App\Libraries
 */
abstract class Creator
{
    /**
     * 创造类实例
     * @param string $classname     类的全名
     * @param array ...$args        参数
     * @return mixed
     *
     */
    public static function make($classname, ...$args)
    {
        unset($args);
        return call_user_func(array($classname, 'getInstance'));
    }
}