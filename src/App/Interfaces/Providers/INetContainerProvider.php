<?php
namespace App\Interfaces\Providers;
use App\Globals\Finals\Responder;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:19
 *
 * Interface IContainerProvider
 * @package App\Interfaces\Providers
 */
interface INetContainerProvider extends IMockContainerProvider
{
    /**
     * 获取数据列表
     * @param array $condz
     * @return Responder
     */
    public function getQueryResult(array $condz= []);

    /**
     * 新增数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCreateResult(array $posts);

    /**
     * 更新数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCommitResult(array $posts);

    /**
     * 保存数据--当只有一组ID列表时使用
     * @param array $aId
     * @return Responder
     */
    public function getPrimaryResult(array $aId);

    /**
     * 删除数据
     * @param array $aId            需要删除数据主键列表
     * @return Responder
     */
    public function getRemoveResult(array $aId);
}