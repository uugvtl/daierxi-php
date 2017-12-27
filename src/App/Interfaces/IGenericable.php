<?php
namespace App\Interfaces;
use App\Injecters\GenericInjecter;

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
     * @param GenericInjecter $injecter
     * @return $this
     */
    public function setGenericInjecter(GenericInjecter $injecter);

    /**
     * @return GenericInjecter
     */
    public function getGenericInjecter();


}