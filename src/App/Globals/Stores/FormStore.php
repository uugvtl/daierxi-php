<?php
namespace App\Globals\Stores;
use App\Globals\Bases\BaseStore;
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
    abstract public function commit();

    abstract public function submit();
}