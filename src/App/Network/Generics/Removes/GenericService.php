<?php
namespace App\Network\Generics\Removes;
use App\Frames\Generics\FrameService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:44
 *
 * Class GenericService
 * @package App\Network\Generics\Removes
 */
abstract class GenericService extends FrameService
{
    /**
     * 设置 相关模块 Repository 的基类名称
     * @return $this
     */
    protected function setBaseRepositoryString()
    {
        $this->getGenericInjecter()->setBaseClassString('RemoveRepository');
        return $this;
    }

    /**
     * 设置 相关模块 Logic 的基类名称
     * @return $this
     */
    protected function setBaseLogicString()
    {
        $this->getGenericInjecter()->setBaseClassString('RemoveLogic');
        return $this;
    }

}
