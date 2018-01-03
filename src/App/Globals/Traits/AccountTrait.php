<?php
namespace App\Globals\Traits;
use Phalcon\DiInterface;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 17:29
 *
 * Trait AccountTrait
 * @package App\Globals\Traits
 */
trait AccountTrait
{
    /**
     * 把登入用户以stdClass的方式保存在$this->account当中，member,user,manager
     * @param DiInterface $di           依赖注入接口
     * @param mixed $loginEntity        登入实体类
     */
    protected function initAccountShare(DiInterface $di, $loginEntity)
    {
        $di->setShared('account', function () use ($loginEntity){
            return $loginEntity;
        });
    }
}