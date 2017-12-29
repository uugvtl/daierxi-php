<?php
namespace App\Creators\Sqlangs;
use App\Creators\BaseCreator;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/12/17
 * Time: 16:15
 *
 * Class SqlangCreator
 * @package App\Creators\Sqlangs
 */
abstract class SqlangCreator extends BaseCreator
{
    private $sqlangName;

    protected function onceConstruct()
    {

    }

    public function create($classname, ...$args)
    {
        $this->getGenericInjecter();
    }

    /**
     * @param string $sqlangName
     * @return $this
     */
    final public function setSqlangName($sqlangName)
    {
        $this->sqlangName = $sqlangName;
        return $this;
    }

    final protected function getSqlangName()
    {
        return $this->sqlangName;
    }

//    protected function getPageInstance()
//    {
//        return PageSlice::getInstance();
//    }
//
//    protected function getFieldsInstance()
//    {
//        $genericInjecter = $this->getGenericInjecter();
//        $package = $genericInjecter->getPackage();
//
//        if($this->getGenericInjecter()->hasGeneralize())
//        {
//            $path = $genericInjecter->getDistributer()->getPath();
//            $classname = $package.BACKSLASH.'Logics'.BACKSLASH.$path.'Logic';
//        }
//        else
//        {
//            $classname = $package.BACKSLASH.'Logics'.BACKSLASH.'QueryLogic';
//        }
//
//        return $classname;
//    }
//
//    protected function getTableInstance()
//    {
//
//    }
//
//    protected function getWhereInstance()
//    {
//
//    }
}