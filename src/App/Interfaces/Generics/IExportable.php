<?php
namespace App\Interfaces\Generics;
use App\Interfaces\Adapters\IShowAdapter;
use App\Interfaces\IGetable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 18:04
 *
 * Interface IExportable
 * @package App\Interfaces\Generics
 */
interface IExportable extends IGetable
{
    /**
     * @return IShowAdapter
     */
    function get();
}