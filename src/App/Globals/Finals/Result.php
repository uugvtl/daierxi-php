<?php
namespace App\Globals\Finals;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/7
 * Time: 00:53
 *
 * Class BaseResult
 * @package App\Globals\Bases\Results
 * @property bool   $toggle
 * @property int    $total
 * @property array  $data
 * @property string $msg;
 * @property int    $code
 */
final class Result
{
    public $toggle;
    public $total;
    public $data;
    public $msg;
    public $code;

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
    final private function __clone(){}

    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct(){}

    /**
     * 初始化单例
     * @return static
     */
    public static function getInstance()
    {
        $static = null;
        $className = get_called_class();

        if(isset(Result::$_instanceCache[$className]))
        {
            $static = Result::$_instanceCache[$className];
        }

        if(empty($static))
        {
            $static = new static();
            $static->onceConstruct();
            Result::$_instanceCache[$className] = $static;

            $static->toggle = false;
            $static->total = 0;
            $static->data = [];
            $static->msg = '';
            $static->code = 0;
        }

        return $static;

    }

}