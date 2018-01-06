<?php
namespace App\Network\Modules\Manager\Generics\Queries\Factories\Services\Index\Index;
use App\Globals\Legals\BaseLegal;
use App\Helpers\InstanceHelper;
use App\Network\Modules\Manager\Generics\Queries\Factories\Services\QueryService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 22:59
 *
 * Class PrimaryService
 * @package App\Network\Modules\Manager\Generics\Queries\Factories\Services\Index\Index
 */
class DefaultService extends QueryService
{
    public function get()
    {
        $instanceHelper = InstanceHelper::getInstance();

        $frameLegal = $instanceHelper->build(BaseLegal::class, $this->getLegalClassString());
        $responder  = $frameLegal->init($this->getGenericInjecter()->getParameter()->get())->get();
        if($responder->toggle)
        {
            $responder = parent::get();
        }

        return $responder;
    }

    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::madeRepositoryInstance();
    }

    protected function madeLogicInstance()
    {
        $this->getGenericInjecter()->setGeneralize(YES);
        return parent::madeLogicInstance();
    }


}