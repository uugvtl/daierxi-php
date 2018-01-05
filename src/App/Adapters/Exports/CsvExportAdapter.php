<?php
namespace App\Adapters\Exports;
use App\Adapters\BaseAdapter;
use App\Interfaces\Adapters\IExportAdapter;
use App\Libraries\Tables\CsvExcel;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/19
 * Time: 12:40
 *
 * Class CsvExportAdapter
 * @package App\Globals\Adapters\Exports
 */
class CsvExportAdapter extends BaseAdapter implements IExportAdapter
{
    /**
     * @var CsvExcel
     */
    protected $adapter;


    protected function afterInstance()
    {
        $this->adapter = CsvExcel::getInstance();
    }

    /**
     * @param array $columns
     * @return static
     */
    public function setColumns(array $columns)
    {
        $this->adapter->setColumns($columns);
        return $this;
    }

    /**
     * @param string $docname
     * @return static
     */
    public function setDocname($docname)
    {
        $this->adapter->setDocname($docname);
        return $this;
    }

    /**
     * @return string
     */
    public function getDocname()
    {
        return $this->adapter->getDocname();
    }

    /**
     * @param array $data
     * @return static
     */
    public function setData(array $data)
    {
        $this->adapter->init($data);
        return $this;
    }

    public function show()
    {
        $this->adapter->output();
    }
}