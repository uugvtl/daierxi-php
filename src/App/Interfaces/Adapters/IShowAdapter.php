<?php
namespace App\Interfaces\Adapters;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 12:30
 *
 * Interface IShowAdapter
 * @package App\Interfaces\Adapters
 */
interface IShowAdapter
{
    /**
     * 导出文件
     * @return void
     */
    public function show();

    /**
     * @param string $docname
     * @return static
     */
    public function setDocname($docname);

    /**
     * @return string
     */
    public function getDocname();

}