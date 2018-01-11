<?php
namespace App\Network\Generics\Exports;
use App\Adapters\Exports\CsvExportAdapter;
use App\Frames\Generics\FrameLogic;
use App\Globals\Stores\SelectStore;
use App\Interfaces\Adapters\IExportAdapter;
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


    protected function afterInstance()
    {
        $this->setStore(SelectStore::getInstance());
    }
}