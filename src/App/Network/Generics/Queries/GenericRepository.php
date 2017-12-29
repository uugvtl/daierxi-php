<?php
namespace App\Network\Generics\Queries;
use App\Globals\Bases\BaseGeneric;
use App\Helpers\InstanceHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericRepository
 * @package App\Network\Generics\Queries
 */
abstract class GenericRepository extends BaseGeneric
{

    protected function createLogicInstance()
    {
        $logicName      = $this->getLogicClassString();
        $instanceHelper = InstanceHelper::getInstance();

        $genericInjecter = $this->getCloneGenericInjecter();

        $logic = $instanceHelper->build(GenericLogic::class, $logicName);
        return $logic->setGenericInjecter($genericInjecter);
    }


    /**
     * @return string
     */
    private function getLogicClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();

        if($this->getGenericInjecter()->hasGeneralize())
        {
            $path = $genericInjecter->getDistributer()->getPath();
            $classname = $package.BACKSLASH.'Logics'.BACKSLASH.$path.'Logic';
        }
        else
        {
            $classname = $package.BACKSLASH.'Logics'.BACKSLASH.'QueryLogic';
        }

        return $classname;
    }

}