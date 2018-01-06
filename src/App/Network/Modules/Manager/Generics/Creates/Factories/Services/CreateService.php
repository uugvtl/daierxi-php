<?php
namespace App\Network\Modules\Manager\Generics\Creates\Factories\Services;
use App\Globals\Legals\BaseLegal;
use App\Helpers\InstanceHelper;
use App\Network\Generics\Creates\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 00:18
 *
 * Class CreateService
 * @package App\Network\Modules\Manager\Generics\Creates\Factories\Services
 */
class CreateService extends GenericService
{
    public function get()
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

    protected function madeLogicInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::madeLogicInstance();
    }


}