<?php
namespace App\Interfaces\Generics;
use App\Globals\Bases\BaseStore;
use App\Interfaces\IRunnable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 15:42
 *
 * Interface IPreservable
 * @package App\Interfaces\Generics
 */
interface IPreservable extends IRunnable
{
    /**
     * @return BaseStore
     */
    public function run();
}