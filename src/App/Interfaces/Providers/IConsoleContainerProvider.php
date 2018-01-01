<?php
namespace App\Interfaces\Providers;
use App\Globals\Finals\Responder;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/10/17
 * Time: 11:45
 *
 * Interface ICliContainerProvider
 * @package App\Interfaces\Providers
 */
interface IConsoleContainerProvider  extends IMockContainerProvider
{
    /**
     * 导出数据列表
     * @param array $params
     * @return Responder
     */
    public function doInitResponder(array $params=[]);
}