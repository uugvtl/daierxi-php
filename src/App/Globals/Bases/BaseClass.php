<?php
namespace App\Globals\Bases;
use App\Globals\Traits\TranslationTrait;
use Phalcon\Mvc\User\Component;
use Phalcon\Config;
/**
 * 所有单例类的基类:此类的子类需要自己实现单例方法--需要自己实现getInstance静态方法:本类中有例子,可以实现传参初始化
 * User: Leon
 * Date: 2016/3/7
 * Time: 12:10
 * @property Config $config
 */
abstract class BaseClass extends Component
{
    use TranslationTrait;

    /**
     * SingleBase constructor.
     * protected标记的构造方法
     */
    private function __construct(){}


    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct(){}


    /**
     * 初始化,在实例生成之后运行
     */
    protected function afterInstance(){}

    /**
     * 单例方法,用于访问实例的公共的静态方法:下面的注释不能取消
     * 返回此类的子类实例
     * @return static
     */
    public static function getInstance()
    {
        $me = new static();/* @var $me static */
        $me->setEventsManager($me->eventsManager);
        $me->onceConstruct();
        return $me;
    }

}