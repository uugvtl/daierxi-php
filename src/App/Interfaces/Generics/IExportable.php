<?php
namespace App\Interfaces\Generics;
use App\Interfaces\Adapters\IShowAdapter;
use App\Interfaces\IRunnable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 18:04
 *
 * Interface IExportable
 * @package App\Interfaces\Generics
 */
interface IExportable extends IRunnable
{
    /**
     * @return IShowAdapter
     */
    public function run();
}