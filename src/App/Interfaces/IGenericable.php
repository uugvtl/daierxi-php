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
     * @param GenericInjecter $injecter
     * @return static
     */
    public function setGenericInjecter(GenericInjecter $injecter);
//
//    /**
//     * @return GenericInjecter
//     */
//    public function getGenericInjecter();


    /**
     * 设置是否使用泛化实例
     * @param bool $boolean     使用为true,否则为false
     * @return $this
     */
    public function useGeneralize($boolean=false);

}