<?php
namespace App\Creators\Sqlangs;
use App\Creators\BaseCreator;
use App\Globals\Finals\PageSlice;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/12/17
 * Time: 16:15
 *
 * Class SqlangCreator
 * @package App\Creators\Sqlangs
 */
class SqlangCreator extends BaseCreator
{
    public function create($classname, ...$args)
    {
        $this->getGenericInjecter();
    }

    protected function getPageInstance()
    {
        return PageSlice::getInstance();
    }

    protected function getFieldsInstance()
    {

    }

    protected function getTableInstance()
    {

    }

    protected function getWhereInstance()
    {

    }
}