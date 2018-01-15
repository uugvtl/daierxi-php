<?php
namespace App\Interfaces;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 12:47
 *
 * Interface IRunnable
 * @package App\Interfaces
 */
interface IGetable
{
    /**
     * 程序入口启动
     * @return mixed
     */
    function get();
}