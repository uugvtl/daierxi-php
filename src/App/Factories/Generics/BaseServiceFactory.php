<?php
namespace App\Factories\Generics;
use App\Globals\Bases\Distributers\BaseService;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 23:47
 *
 * Class BaseServiceFactory
 * @package App\Factories\Generics
 */
abstract class BaseServiceFactory extends BaseFactory
{
    /**
     * @return BaseService
     */
    abstract public function createInstance();
}