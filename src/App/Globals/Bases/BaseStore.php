<?php
namespace App\Globals\Bases;
use App\Libraries\Daoes\CacheDao;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 16/8/30
 * Time: 16:29
 *
 * Class BaseStore
 * @package App\Globals\Bases
 */
abstract class BaseStore extends BaseSingle
{
    /**
     * 操作数据的封状工具类
     * @var CacheDao
     */
    protected $dao;

    /**
     * 获取的查询数据DAO
     * @return CacheDao
     */
    public function getDao()
    {
        return $this->dao;
    }

}