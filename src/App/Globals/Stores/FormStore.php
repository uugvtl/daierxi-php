<?php
namespace App\Globals\Stores;
use App\Globals\Bases\BaseStore;
use App\Libraries\Daoes\FormDao;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/8/17
 * Time: 13:14
 *
 * Class ExecuteStore
 * @package App\Globals\Stores
 */
abstract class FormStore extends BaseStore
{
    /**
     * 操作数据的封状工具类
     * @var FormDao
     */
    protected $dao;

    abstract public function commit();

    abstract public function submit();
}