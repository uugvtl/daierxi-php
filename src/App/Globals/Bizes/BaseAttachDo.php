<?php
namespace App\Globals\Bizes;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 22:09
 *
 * Class BaseAttachDo
 * @package App\Globals\Bizes
 * @property int    $primary_id     绑定关系时的唯一键值
 * @property array  $attaches       绑定关系时的多个从键值，每个元素具体含义由子类定义
 */
abstract class BaseAttachDo extends BaseDo
{
    protected function column()
    {
        return [
            'primary_id',
            'attaches'
        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->primary_id;
    }
}