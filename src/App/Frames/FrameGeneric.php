<?php
namespace App\Frames;
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
abstract class FrameGeneric extends FrameClass implements IGenericable
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
    final protected function getGenericInjecter()
    {
        return $this->genericInjecter;
    }

    /**
     * 设置是否使用 Ctrl 与 Act 下面的泛型类
     * @param bool $boolean             使用泛型类为true 否则为false
     * @return $this
     */
    final public function useGeneralize($boolean = false)
    {
        $this->genericInjecter->useGeneralize($boolean);
        return $this;
    }


    /**
     * 是否使用 Ctrl 与 Act 下面的泛型类
     * @return bool
     */
    final protected function hasGeneralize()
    {
        return $this->genericInjecter->hasGeneralize();
    }


}