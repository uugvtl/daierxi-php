<?php
namespace App\Network\Generics\Creates;
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

}