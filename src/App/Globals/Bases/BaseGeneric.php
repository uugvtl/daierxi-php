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
     * @var boolean
     */
    private $generalize;

    /**
     * @var GenericInjecter
     */
    private $genericInjecter;

    /**
     * 设置是否使用泛化实例
     * @param bool $boolean     使用为true,否则为false
     * @return $this
     */
    public function setGeneralize($boolean=false)
    {
        $this->generalize = $boolean;
        return $this;
    }

    /**
     * 判断是否使用泛化实例
     * @return bool
     */
    public function isGeneralize()
    {
        return $this->generalize;
    }

    /**
     * @param GenericInjecter $injecter
     * @return $this
     */
    public function cloneGenericInjecter(GenericInjecter $injecter)
    {
        $this->genericInjecter = clone $injecter;
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