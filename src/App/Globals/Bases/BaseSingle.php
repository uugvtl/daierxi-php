<?php
namespace App\Globals\Bases;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 22/12/17
 * Time: 15:49
 * Class CSingleHelper
 */
abstract class BaseSingle
{

    /**
     * @var array 实例缓存
     */
    private static $_instanceCache=array();

    /**
     * protected标记的构造方法
     */
    private function __construct(){}

    /**
     * 创建__clone方法防止对象被复制克隆
     */
    private function __clone(){}

    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct(){}

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
     * 实例产生方法
     * @return static
     */
    public static function getInstance()
    {
        $static = null;
        $className = get_called_class();

        if(isset(BaseSingle::$_instanceCache[$className]))
        {
            $static = BaseSingle::$_instanceCache[$className];
        }

        if(empty($static))
        {
            $static = new static();
            $static->onceConstruct();
            BaseSingle::$_instanceCache[$className] = $static;
        }

        return $static;

    }

}