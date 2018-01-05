<?php
namespace App\Interfaces\Generics;
use App\Injecters\SqlangInjecter;
use App\Interfaces\IGetable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 15:42
 *
 * Interface IPreservable
 * @package App\Interfaces\Generics
 */
interface IPreservable extends IGetable
{
    /**
     * @return SqlangInjecter
     */
    public function get();

    /**
     * 设置 sqlang 的相关目录名称
     * @param $sqlangCatalog
     * @return $this
     */
    public function setSqlangCatalog($sqlangCatalog);

}