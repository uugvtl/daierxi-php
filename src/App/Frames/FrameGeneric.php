<?php
namespace App\Frames;
use App\Globals\Bases\BaseClass;
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
abstract class FrameGeneric extends BaseClass implements IGenericable
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

}