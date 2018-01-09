<?php
namespace App\Globals\Bizes;
use App\Globals\Bases\BaseBiz;
use App\Libraries\Caches\BaseCache;
/**
 * 有持久化功能的业务实例
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 19:53
 *
 * Class BaseDo
 * @package App\Globals\Bizes
 */
abstract class BaseDO extends BaseBiz
{
    /**
     * @var BaseCache
     */
    private $cache;

    /**
     * 是否为新增数据
     * @var bool
     */
    private $insertion;

    /**
     * 数据持久化后，需要改变此状态为true
     * @var bool
     */
    private $persistent;

    /**
     * 新增数据到库，无事务更新操作
     * @return $this
     */
    abstract public function insert();

    /**
     * 保存数据到库，无事务更新操作
     * @return $this
     */
    abstract public function submit();


    /**
     * 获取主键，如果是数组的形式的话返回的是serialize后的数组
     * @return mixed
     */
    abstract public function primaryKey();

    /**
     * 设置是否为新增数据
     * @param bool $insertion       新增为true,否则为false
     * @return $this
     */
    final public function setInsertion($insertion)
    {
        $this->insertion = (bool)$insertion;
        return $this;
    }

    /**
     * @return bool
     */
    final public function isPersistent()
    {
        return $this->persistent?true:false;
    }

    /**
     * @return bool
     */
    final public function isInsertion()
    {
        return $this->insertion?true:false;
    }

    /**
     * 设置是否持久化操作
     * @param bool $persistent      已持久化操作true,否则为false
     * @return $this
     */
    final protected function setPersistent($persistent)
    {
        $this->persistent = (bool)$persistent;
        return $this;
    }

    /**
     * @return BaseCache
     */
    final protected function getCache()
    {
        return $this->cache;
    }

    /**
     * @param BaseCache $cache
     * @return $this
     */
    final public function setCache(BaseCache $cache)
    {
        $this->cache = $cache;
        return $this;
    }

}