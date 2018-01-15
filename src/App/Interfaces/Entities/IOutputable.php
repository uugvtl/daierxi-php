<?php
namespace App\Interfaces\Entities;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 14:24
 *
 * Interface IOutputable
 * @package App\Interfaces\Entities
 */
interface IOutputable
{
    /**
     * 设置出库单的打印状态为已打印
     * @return static
     */
    function setPrinted();

    /**
     * 此出库单是否已打印
     * @return bool
     */
    function isPrinted();

    /**
     * 此出库单是否为线上的订单
     * @return bool
     */
    function isOnline();

    /**
     * @return static
     */
    function initStatusBo();

    /**
     * @param int $output_status
     * @return IChangeStatusable
     */
    function madeStatusBo($output_status);

    /**
     * @param IChangeStatusable $statusBo
     * @return static
     */
    function setStatusBo(IChangeStatusable $statusBo);

    /**
     * 获取出库状态码
     * @return mixed
     */
    function getStatusCode();
}