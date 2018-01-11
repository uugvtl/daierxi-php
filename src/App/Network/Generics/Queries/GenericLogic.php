<?php
namespace App\Network\Generics\Queries;
use App\Frames\Generics\FrameLogic;
use App\Globals\Finals\Responder;
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

    public function get()
    {
        $this->beforeBegin();
        $responder = Responder::getInstance();
        $this->run($responder);
        $this->afterEnd();
        return $responder;
    }


}