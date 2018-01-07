<?php
namespace App\Globals\Bizes;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 22:13
 *
 * Class BaseDisabledDo
 * @package App\Globals\Bizes
 * @property string $disabled       数据状态开关
 * @property string $items          具体含义需要实现类来定义
 */
abstract class BaseDisabledDo extends BaseDo
{
    protected function column()
    {
        return [
            'disabled',
            'items',
        ];
    }

    /**
     * @return mixed
     */
    public function primaryKey()
    {
        return $this->items;
    }
}