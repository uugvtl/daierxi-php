<?php
namespace App\Globals\Bizes;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 22:07
 *
 * Class BaseEnabledDo
 * @package App\Globals\Bizes
 * @property string $enabled        数据状态开关
 * @property string $items          具体含义需要实现类来定义
 */
abstract class BaseEnabledDO extends BaseDO
{
    protected function column()
    {
        return [
            'enabled',
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