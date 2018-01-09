<?php
namespace App\Console\Generics\Crontabs;
use App\Frames\Generics\FrameService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:48
 *
 * Class GenericService
 * @package App\Console\Generics\Crontabs
 */
abstract class GenericService extends FrameService
{
    /**
     * 设置 相关模块 Repository 的基类名称
     * @return $this
     */
    final protected function setBaseRepositoryString()
    {
        $this->getGenericInjecter()->setBaseClassString('CrontabRepository');
        return $this;
    }

    /**
     * 设置 相关模块 Logic 的基类名称
     * @return $this
     */
    final protected function setBaseLogicString()
    {
        $this->getGenericInjecter()->setBaseClassString('CrontabLogic');
        return $this;
    }

}