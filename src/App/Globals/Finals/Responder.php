<?php
namespace App\Globals\Finals;
use App\Globals\Bases\BaseClass;
use App\Interfaces\Adapters\IShowAdapter;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/7
 * Time: 00:53
 *
 * Class BaseResult
 * @package App\Globals\Bases\Results
 * @property bool           $toggle
 * @property int            $total
 * @property array          $data
 * @property string         $msg;
 * @property int            $code
 * @property IShowAdapter   $adapter
 */
final class Responder extends BaseClass
{
    public $toggle;
    public $total;
    public $data;
    public $msg;
    public $code;
    public $adapter;
    /**
     * 单例方法,用于访问实例的公共的静态方法:下面的注释不能取消
     * 返回此类的子类实例
     * @return static
     */
    public static function getInstance()
    {
        $me = new static();
        $me->toggle = false;
        $me->total = 0;
        $me->data = [];
        $me->msg = '';
        $me->code = 0;
        $me->adapter = null;
        $me->afterInstance();
        return $me;
    }


}