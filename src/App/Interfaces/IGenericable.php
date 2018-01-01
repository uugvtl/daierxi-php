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

    /**
     * @return GenericInjecter
     */
    public function getGenericInjecter();

}