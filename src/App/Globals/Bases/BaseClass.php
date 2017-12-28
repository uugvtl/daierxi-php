<?php
namespace App\Globals\Bases;
use App\Globals\Traits\TranslationTrait;
use Phalcon\Config;
/**
 * 所有单例类的基类:此类的子类需要自己实现单例方法--需要自己实现getInstance静态方法:本类中有例子,可以实现传参初始化
 * User: Leon
 * Date: 2016/3/7
 * Time: 12:10
 * @property Config $config
 */
abstract class BaseClass
{
    use TranslationTrait;

    private function __construct(){}

    /**
     * 初始化,在实例生成之后运行
     */
    protected function afterInstance(){}

    /**
     * 手动初始化模板方法--可以被子类实现
     * @param array ...$args
     * @return static
     */
    public function init(...$args)
    {
        unset($args);
        return $this;
    }

    /**
     * 单例方法,用于访问实例的公共的静态方法:下面的注释不能取消
     * 返回此类的子类实例
     * @return static
     */
    public static function getInstance()
    {
        $me = new static();
        $me->afterInstance();
        return $me;
    }

    /**
     * @return static
     */
    public function getClone()
    {
        return clone $this;
    }
}