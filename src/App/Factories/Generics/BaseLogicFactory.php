<?php
namespace App\Factories\Generics;
use App\Globals\Bases\Distributers\BaseLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 23:49
 *
 * Class BaseLogicFactory
 * @package App\Factories\Generics
 */
abstract class BaseLogicFactory extends BaseFactory
{
    /**
     * @return BaseLogic
     */
    abstract public function createInstance();
}