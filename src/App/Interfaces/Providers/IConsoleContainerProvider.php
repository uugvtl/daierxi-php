<?php
namespace App\Interfaces\Providers;
use App\Frames\Generics\FrameContainer;
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
     * 实初始化一些数据
     * @param array $condz
     * @return FrameContainer
     */
    public function getInitContainer(array $condz=[]);

    /**
     * 排程数据运行
     * @param array $condz
     * @return FrameContainer
     */
    public function getCronContainer(array $condz=[]);
}