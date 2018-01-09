<?php
namespace App\Network\Generics\Modifies;
use App\Frames\Generics\FrameService;
use App\Globals\Legals\BaseLegal;
use App\Helpers\InstanceHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:05
 *
 * Class GenericService
 * @package App\Network\Generics\Creates
 */
abstract class GenericService extends FrameService
{

    final public function get()
    {

        $instanceHelper = InstanceHelper::getInstance();

        $frameLegal = $instanceHelper->build(BaseLegal::class, $this->getLegalClassString());
        $responder  = $frameLegal->init($this->getGenericInjecter()->getParameter()->get())->get();
        if($responder->toggle)
        {
            $repository = $this->madeRepositoryInstance();
            $logic = $this->madeLogicInstance();
            $responder = $logic->init($repository)->get();
        }

        return $responder;

    }

    /**
     * 设置 相关模块 Repository 的基类名称
     * @return $this
     */
    final protected function setBaseRepositoryString()
    {
        $this->getGenericInjecter()->setBaseClassString('ModifyRepository');
        return $this;
    }

    /**
     * 设置 相关模块 Logic 的基类名称
     * @return $this
     */
    final protected function setBaseLogicString()
    {
        $this->getGenericInjecter()->setBaseClassString('ModifyLogic');
        return $this;
    }

}