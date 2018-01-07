<?php
namespace App\Network\Generics\Modifies;
use App\Frames\Generics\FrameService;
use App\Globals\Legals\BaseLegal;
use App\Helpers\InstanceHelper;
use App\Interfaces\Generics\IRespondable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:05
 *
 * Class GenericService
 * @package App\Network\Generics\Creates
 */
abstract class GenericService extends FrameService  implements IRespondable
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

    protected function madeRepositoryInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('ModifyRepository');
        $repositoryName = $this->getRepositoryClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $repository = $instanceHelper->build(GenericRepository::class, $repositoryName);
        return $repository->setGenericInjecter($cloneGenericInjecter);
    }

    protected function madeLogicInstance()
    {
        $cloneGenericInjecter = $this->getGenericInjecter()->getClone();

        $this->getGenericInjecter()->setBaseClassString('ModifyLogic');
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();



        $logic = $instanceHelper->build(GenericLogic::class, $logicName);
        return $logic->setGenericInjecter($cloneGenericInjecter);
    }
}