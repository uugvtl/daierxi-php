<?php
namespace App\Globals\Generics;
use App\Globals\Bases\BaseGeneric;
/**
 * 用来生成 Sqlang 和 Store 相关类的工厂类
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:10
 *
 * Class BaseLogic
 * @package App\Globals\Generics
 */
abstract class BaseLogic extends BaseGeneric
{
    private $repository;

    public function init(...$args)
    {
        $repository = $args[0];
        $this->repository = $repository;
        return $this;
    }

    protected function getRepositpry()
    {
        return $this->repository;
    }
}