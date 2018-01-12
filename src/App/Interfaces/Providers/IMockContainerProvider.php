<?php
namespace App\Interfaces\Providers;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/10/17
 * Time: 14:59
 *
 * Interface IMockContainerProvider
 * @package App\Interfaces\Providers
 */
interface IMockContainerProvider
{
    /**
     * 设置 要使用的 Container类前辍名称
     * @param string $containerPrefix
     * @return $this
     */
    public function setGenericContainerPrefix($containerPrefix);
}