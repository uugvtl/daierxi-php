<?php
namespace App\Globals\Bases;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/18
 * Time: 01:33
 *
 * Class BaseSingle
 * @package App\Globals\Bases
 */
abstract class BaseSingle  extends BaseClass
{
    /**
     * @var array 实例缓存
     */
    private static $_instanceCache=array();

    /**
     * 创建__clone方法防止对象被复制克隆
     */
    final private function __clone(){}


    /**
     * 单例方法,用于访问实例的公共的静态方法:下面的注释不能取消
     * 返回此类的子类实例
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
            $static->setEventsManager($static->eventsManager);
            $static->onceConstruct();
            BaseSingle::$_instanceCache[$className] = $static;
        }

        $static->afterInstance();
        return $static;
    }

}