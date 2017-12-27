<?php
namespace App\Factories\Generics;
use App\Globals\Bases\Generics\BaseRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 23:49
 *
 * Class BaseRepositoryFactory
 * @package App\Factories\Generics
 */
abstract class BaseRepositoryFactory extends BaseFactory
{
    /**
     * @return BaseRepository
     */
    abstract public function createInstance();
}