<?php
namespace App\Frames;
use Phalcon\Config;
use Phalcon\Mvc\User\Plugin;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/18
 * Time: 01:33
 *
 * Class BaseSingle
 * @package App\Globals\Bases
 * @property Config $config
 */
abstract class FrameSingle extends Plugin
{
    /**
     * @var array 实例缓存
     */
    private static $_instanceCache=array();

    /**
     * 创建__clone方法防止对象被复制克隆
     */
    private function __clone(){}

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
     * 初始化模板方法，子类可以进行overload
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
        $static = null;
        $className = get_called_class();

        if(isset(FrameSingle::$_instanceCache[$className]))
        {
            $static = FrameSingle::$_instanceCache[$className];
        }

        if(empty($static))
        {
            $static = new static();
            $static->setEventsManager($static->eventsManager);
            $static->onceConstruct();
            FrameSingle::$_instanceCache[$className] = $static;
        }

        $static->afterInstance();
        return $static;
    }

}