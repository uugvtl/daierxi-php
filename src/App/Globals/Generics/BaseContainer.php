<?php
namespace App\Globals\Generics;
use App\Globals\Bases\BaseGeneric;
use App\Interfaces\IGetable;
/**
 * 用来生成 Service 相关类的工厂类
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:39
 *
 * Class BaseContainer
 * @package App\Globals\Generics
 */
abstract class BaseContainer extends BaseGeneric implements IGetable
{
    /**
     * @return mixed
     */
    abstract protected function createService();

    final protected function getServiceClassString()
    {

        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getPath();

        if($genericInjecter->hasGeneralize())
        {
            $classname = $package.BACKSLASH.'Services'.BACKSLASH.$path.'Service';
        }
        else
        {
            $classname = $package.BACKSLASH.'Services'.BACKSLASH.$genericInjecter->getBaseClassString();
        }

        return $classname;
    }
}