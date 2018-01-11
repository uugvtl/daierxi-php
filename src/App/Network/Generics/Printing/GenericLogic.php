<?php
namespace App\Network\Generics\Printing;
use App\Adapters\Printing\PdfPrintAdapter;
use App\Frames\Generics\FrameLogic;
use App\Globals\Stores\SelectStore;
use App\Interfaces\Adapters\IPrintAdapter;
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
    /**
     * @var IPrintAdapter
     */
    private $adapter;

    /**
     * @return IPrintAdapter
     */
    final protected function getAdapter()
    {
        $this->adapter || $this->adapter = PdfPrintAdapter::getInstance();
        return $this->adapter;
    }

    final protected function afterInstance()
    {
        $this->setStore(SelectStore::getInstance());
    }

}