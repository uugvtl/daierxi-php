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
    public function setPrinted();

    /**
     * 此出库单是否已打印
     * @return bool
     */
    public function isPrinted();

    /**
     * 此出库单是否为线上的订单
     * @return bool
     */
    public function isOnline();

    /**
     * @return static
     */
    public function initStatusBo();

    /**
     * @param int $output_status
     * @return IChangeStatusable
     */
    public function createStatusBo($output_status);

    /**
     * @param IChangeStatusable $statusBo
     * @return static
     */
    public function setStatusBo(IChangeStatusable $statusBo);

    /**
     * 获取出库状态码
     * @return mixed
     */
    public function getStatusCode();
}