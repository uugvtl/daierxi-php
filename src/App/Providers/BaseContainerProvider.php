<?php
namespace App\Providers;
use App\Globals\Bases\BaseClass;
use App\Globals\Finals\Distributer;
use App\Globals\Finals\Parameter;
use App\Helpers\ErrorsHelper;
use App\Injecters\GenericInjecter;
use App\Interfaces\Providers\IMockContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:11
 *
 * Class MockContainerProvider
 * @package App\Network\Providers
 */
abstract class BaseContainerProvider extends BaseClass implements IMockContainerProvider
{
    /**
     * @var GenericInjecter
     */
    private $genericInjecter;


    public function init(...$args)
    {
        $distributer = $args[0];

        if(!$distributer instanceof Distributer)
        {
            $errorsHelper = ErrorsHelper::getInstance();
            $errorsHelper->triggerError('init method only accepts Class Distributer. Input was: '.$distributer);
        }

        $parameter = Parameter::getInstance();
        $this->genericInjecter = GenericInjecter::getInstance();

        $this->genericInjecter->setDistributer($distributer);
        $this->genericInjecter->setParameter($parameter);

        return $this;
    }

    /**
     * 设置是否使用泛化实例
     * @param bool $boolean     使用为true,否则为false
     * @return $this
     */
    public function setGeneralize($boolean=false)
    {
        $this->genericInjecter->setGeneralize($boolean);
        return $this;
    }

    /**
     * 判断是否使用泛化实例
     * @return bool
     */
    public function hasGeneralize()
    {
        return $this->genericInjecter->hasGeneralize();
    }

    /**
     * @return GenericInjecter
     */
    protected function getGenericInjecter()
    {
        return $this->genericInjecter;
    }

}