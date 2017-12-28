<?php
namespace App\Globals\Bases;
use App\Injecters\GenericInjecter;
use App\Interfaces\IGenericable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 01:56
 *
 * Class BaseGeneric
 * @package App\Globals\Bases
 */
abstract class BaseGeneric extends BaseClass implements IGenericable
{

    /**
     * @var GenericInjecter
     */
    private $genericInjecter;


    public function setGenericInjecter(GenericInjecter $injecter)
    {
        $this->genericInjecter = $injecter;
        return $this;
    }

    /**
     * @return GenericInjecter
     */
    public function getGenericInjecter()
    {
        return $this->genericInjecter;
    }

}