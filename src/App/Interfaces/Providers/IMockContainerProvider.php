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
     * 是否是使用泛化模块当中的 Container
     * @param bool $useModuleGenericContainer
     * @return $this
     */
    public function useGenericContainer($useModuleGenericContainer);
}