<?php
namespace App\Providers;
use App\Globals\Bases\BaseSingle;
use App\Globals\Finals\Distributer;
use App\Globals\Finals\Parameter;
use App\Interfaces\Providers\IMockContainerProvider;
use InvalidArgumentException;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:11
 *
 * Class MockContainerProvider
 * @package App\Network\Providers
 */
abstract class BaseContainerProvider extends BaseSingle implements IMockContainerProvider
{
    /**
     * @var Distributer
     */
    private $distributer;

    /**
     * @var Parameter
     */
    private $parameter;

    /**
     * @var boolean
     */
    private $generalize;


    public function init(...$args)
    {
        $distributer = $args[0];

        if($distributer instanceof Distributer)
            $this->distributer = $args[0];
        else
            throw new InvalidArgumentException('tripleInteger function only accepts Class Distributer. Input was: '.$distributer);

        $this->parameter = Parameter::getInstance();

        return $this;
    }

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
    public function hasGeneralize()
    {
        return $this->generalize;
    }

    /**
     * @return Distributer
     */
    protected function getDistributer()
    {
        return $this->distributer;
    }

    /**
     * @return Parameter
     */
    protected function getParameter()
    {
        return $this->parameter;
    }

}