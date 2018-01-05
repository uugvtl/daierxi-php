<?php
namespace App\Network\Generics\Printing;
use App\Adapters\Printing\PdfPrintAdapter;
use App\Globals\Finals\Responder;
use App\Frames\Generics\FrameLogic;
use App\Interfaces\Adapters\IPrintAdapter;
use App\Interfaces\Generics\IPrintable;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericLogic
 * @package App\Network\Generics\Queries
 */
abstract class GenericLogic  extends FrameLogic implements IPrintable
{
    /**
     * @var IPrintAdapter
     */
    private $adapter;

    protected function afterInstance()
    {
        $this->adapter = PdfPrintAdapter::getInstance();
    }

    /**
     * @return IPrintAdapter
     */
    final protected function getAdapter()
    {
        return $this->adapter;
    }

    final public function get()
    {
        $responder = Responder::getInstance();
        $this->commit($responder);
        return $responder;
    }

}