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


    final public function setGenericInjecter(GenericInjecter $injecter)
    {
        $this->genericInjecter = $injecter;
        return $this;
    }

    /**
     * @return GenericInjecter
     */
    final public function getGenericInjecter()
    {
        return $this->genericInjecter;
    }

    /**
     * 可以overwrite 此方法，主要是用来写是否可以泛化
     * @return GenericInjecter
     */
    protected function getCloneGenericInjecter()
    {
        return $this->getGenericInjecter()->getClone();
    }
}