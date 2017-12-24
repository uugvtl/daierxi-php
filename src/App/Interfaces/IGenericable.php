<?php
namespace App\Interfaces;
use App\Globals\Finals\Parameter;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 01:58
 *
 * Interface IGenericable
 * @package App\Interfaces
 */
interface IGenericable
{
    /**
     * 设置是否使用泛化实例
     * @param bool $boolean     使用为true,否则为false
     * @return $this
     */
    public function setGeneralize($boolean=false);

    /**
     * 判断是否使用泛化实例
     * @return bool
     */
    public function isGeneralize();

    /**
     * 设置参数实例
     * @param Parameter $parameter
     * @return $this
     */
    public function setParameter(Parameter $parameter);

    /**
     * 克隆参数实例
     * @param Parameter $parameter
     * @return $this
     */
    public function cloneParameter(Parameter $parameter);

    /**
     * @return Parameter
     */
    public function getParameter();
}