<?php
namespace App\Adapters;
use App\Globals\Bases\BaseClass;
use App\Interfaces\Adapters\IShowAdapter;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 14:57
 *
 * Class BaseAdapter
 * @package App\Adapters
 */
abstract class BaseAdapter extends BaseClass implements IShowAdapter
{
    /**
     * @var IShowAdapter
     */
    protected $adapter;

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
}