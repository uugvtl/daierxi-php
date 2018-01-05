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
     * @param array $column
     * @return static
     */
    public function setColumn(array $column);


    /**
     * @param array $data
     * @return static
     */
    public function setData(array $data);
}