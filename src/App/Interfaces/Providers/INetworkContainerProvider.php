<?php
namespace App\Interfaces\Providers;
use App\Frames\Generics\FrameContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:19
 *
 * Interface IContainerProvider
 * @package App\Interfaces\Providers
 */
interface INetworkContainerProvider extends IMockContainerProvider
{
    /**
     * 导出数据列表
     * @param array $condz
     * @return FrameContainer
     */
    function getExportContainer(array $condz= []);

    /**
     * 显示打印数据
     * @param array $condz            需要删除数据主键列表
     * @return FrameContainer
     */
    function getPrintContainer(array $condz= []);

    /**
     * 获取数据列表
     * @param array $condz
     * @return FrameContainer
     */
    function getQueryContainer(array $condz= []);

    /**
     * 新增数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return FrameContainer
     */
    function getCreateContainer(array $posts);

    /**
     * 更新数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return FrameContainer
     */
    function getCommitContainer(array $posts);

    /**
     * 保存数据--当只有一组ID列表时使用
     * @param array $aId
     * @return FrameContainer
     */
    function getPrimaryContainer(array $aId);

    /**
     * 删除数据
     * @param array $aId            需要删除数据主键列表
     * @return FrameContainer
     */
    function getRemoveContainer(array $aId=[]);
}