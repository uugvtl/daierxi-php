<?php
namespace App\Globals\Traits;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 15:42
 *
 * Trait AmountTrait
 * @package App\Globals\Traits
 */
trait AmountTrait
{
    /**
     * 是否已减少
     * @var bool
     */
    private $decreased;

    /**
     * 是否已增加
     * @var bool
     */
    private $increased;

    /**
     * 设置状态为已增加
     * @return $this
     */
    protected function increased()
    {
        $this->increased = true;
        return $this;
    }

    /**
     * 获取增加状态
     * @return bool
     */
    protected function isIncreased()
    {
        return $this->increased;
    }

    /**
     * @return $this
     */
    protected function increase()
    {
        if(!$this->isIncreased())
        {
            if($this->doIncreased())
                $this->isIncreased();
        }

        return $this;
    }

    /**
     * 设置状态为已减少
     * @return $this
     */
    protected function decreased()
    {
        $this->decreased = true;
        return $this;
    }

    /**
     * 获取减少状态
     * @return bool
     */
    protected function isDecreased()
    {
        return $this->decreased;
    }

    /**
     * @return $this
     */
    protected function decrease()
    {
        if(!$this->isDecreased())
        {
            if($this->doDecrease())
                $this->decreased();
        }

        return $this;
    }

    /**
     * 具体实现减少逻辑
     * @return bool
     */
    protected function doDecrease()
    {
        return false;
    }

    /**
     * 具体实现逻辑增加
     * @return bool
     */
    protected function doIncreased()
    {
        return false;
    }
}