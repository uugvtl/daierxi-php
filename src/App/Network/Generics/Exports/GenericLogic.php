<?php
namespace App\Network\Generics\Exports;
use App\Frames\Generics\FrameLogic;
use App\Globals\Finals\Responder;
use App\Interfaces\Adapters\IExportAdapter;
use App\Interfaces\Generics\IExportable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericLogic
 * @package App\Network\Generics\Queries
 */
abstract class GenericLogic  extends FrameLogic implements IExportable
{
    /**
     * @var IExportAdapter
     */
    protected $adapter;

    final public function get()
    {
        $responder = Responder::getInstance();
        $this->run($responder);
        return $responder;
    }
}