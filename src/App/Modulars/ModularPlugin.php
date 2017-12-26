<?php
namespace App\Modulars;
use App\Globals\Traits\TranslationTrait;
use Phalcon\Mvc\User\Plugin;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 13:40
 *
 * Class ModularPlugin
 * @package App\Modulars
 */
abstract class ModularPlugin extends Plugin
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
        $me = new static();
        $me->setEventsManager($me->eventsManager);
        $me->afterInstance();
        return $me;
    }
}