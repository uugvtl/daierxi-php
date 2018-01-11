<?php
namespace App\Network\Generics\Queries;
use App\Frames\Generics\FrameLogic;
use App\Globals\Stores\SelectStore;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericLogic
 * @package App\Network\Generics\Queries
 */
abstract class GenericLogic  extends FrameLogic
{

    protected function afterInstance()
    {
        $this->setStore(SelectStore::getInstance());
    }
}