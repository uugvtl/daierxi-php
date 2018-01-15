<?php
namespace App\Interfaces\Adapters;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 15:22
 *
 * Interface IExportAdapter
 * @package App\Interfaces\Adapters
 */
interface IExportAdapter extends IShowAdapter
{
    /**
     * @param array $columns
     * @return static
     */
    function setColumns(array $columns);


    /**
     * @param array $data
     * @return static
     */
    function setData(array $data);
}