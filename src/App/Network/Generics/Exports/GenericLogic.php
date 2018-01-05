<?php
namespace App\Network\Generics\Exports;
use App\Adapters\Exports\CsvExportAdapter;
use App\Frames\Generics\FrameLogic;
use App\Globals\Finals\Responder;
use App\Globals\Stores\SelectStore;
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
    private $adapter;

    /**
     * @return IExportAdapter
     */
    final protected function getAdapter()
    {
        $this->adapter || $this->adapter = CsvExportAdapter::getInstance();
        return $this->adapter;
    }

    final public function get()
    {
        $responder = Responder::getInstance();
        $this->run($responder);
        return $responder;
    }

    protected function afterInstance()
    {
        $this->setStore(SelectStore::getInstance());
    }
}