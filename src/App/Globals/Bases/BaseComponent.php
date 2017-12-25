<?php
namespace App\Globals\Bases;
use App\Globals\Traits\TranslationTrait;
use Phalcon\Mvc\User\Component;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 21:34
 *
 * Class BaseComponent
 * @package App\Globals\Bases
 */
class BaseComponent extends Component
{
    use TranslationTrait;

    private function __construct(){}

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
        $me->afterInstance();
        return $me;
    }
}