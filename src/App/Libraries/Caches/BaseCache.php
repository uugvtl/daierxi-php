<?php
namespace App\Libraries\Caches;
use App\Globals\Bases\BaseSingle;
use App\Libraries\Caches\Dependencies\BaseCacheDependency;
use App\Libraries\Daoes\FrameDao;
use InvalidArgumentException;
use Phalcon\Cache\BackendInterface;
use Phalcon\Config;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 14:10
 *
 * Class BaseCache
 * @package App\Libraries\Caching
 * @property Config $config
 */
abstract class BaseCache extends BaseSingle
{
    /**
     * 缓存时间，单位为秒，例如缓存30秒，设置此值为30; 0表示永不过期。
     * @var int
     */
    protected $lifetime = 172800;

    /**
     * 缓存时间，单位为秒，例如缓存30秒，设置此值为30; 0表示永不过期。
     * @var int
     */
    protected $shorttime = 180;

    /**
     * 缓存助手实例
     * @var BackendInterface
     */
    protected $cache;

    /**
     * @var FrameDao
     */
    private $dao;

    /**
     * @var BaseCacheDependency[]
     */
    private $dependencies;

    /**
     * @param BaseCacheDependency[]         $dependencies   文件缓存依赖对象
     * @return $this
     */
    final public function setDependencies(array $dependencies)
    {
        $this->dependencies = $dependencies;
        return $this;
    }

    /**
     * @return BaseCacheDependency[]
     */
    final public function getDependencies()
    {
        return $this->dependencies;
    }

    public function init(...$args)
    {
        $cache = $args[0];
        if($cache instanceof BackendInterface)
            $this->cache    = $cache;
        else
            throw new InvalidArgumentException('init method only accepts Interface BackendInterface. Input was: '.$cache);

        return $this;
    }

    /**
     * 获取以数据库查询数据为基础的缓存--单项数据
     * @param string                        $sql			SQL语句
     * @return mixed                                        数据库查询数据
     */
    abstract public function getOne($sql);

    /**
     * 获取以数据库查询数据为基础的缓存--单条数据
     * @param string                        $sql			SQL语句
     * @return mixed                                        数据库查询数据
     */
    abstract public function getRow($sql);

    /**
     * 获取以数据库查询数据为基础的缓存--数据集
     * @param string                        $sql			SQL语句
     * @return mixed                                        数据库查询数据
     */
    abstract public function getAll($sql);

    /**
     * 通过文件名获取缓存文件依赖对象--保存在缓存文件依赖目录:selete操作使用
     * @param string|array $tableNames          一组依赖文件名称--表名称
     * @return BaseCacheDependency[]            缓存文件依赖对象
     */
    abstract public function createCacheDependencies($tableNames);


    /**
     * 更新缓存依赖
     * @param string|array $tableNames      一组依赖文件名称--表名称
     * @return boolean                      更新成功返回true,否则返回false
     */
    abstract public function updateCacheDependencies($tableNames);


    /**
     * @return FrameDao
     */
    public function getDao()
    {
        return $this->dao;
    }

    /**
     * 设置缓存
     * @param string $key       缓存名称
     * @param mixed $data       缓存数据，可以被序列化的才行
     * @param int $lifetime     过期时间，0为使用默认过期时间
     * @return boolean          保存成功返回true, 否则返回false
     */
    public function set($key, $data, $lifetime=0)
    {
        if(empty($lifetime))
            $lifetime=$this->lifetime;

        $toggle = $this->$this->cache->save($key, $data, $lifetime);
        return $toggle;
    }


    /**
     * 获取缓存
     * @param string $key       缓存名称
     * @return array            保存成功返回true, 否则返回false
     */
    public function get($key)
    {
        $data=null;
        if($this->$this->cache->exists($key)){
            $data = $this->$this->cache->get($key);
        }
        return $data;

    }

    /**
     * 删除指定键名的缓存
     * @param string $key       缓存键名
     * @return boolean          删除成功返回true, 否则返回false
     */
    public function del($key)
    {
        return $this->$this->cache->delete($key);
    }

    /**
     * 清除所有缓存
     * @return boolean              删除成功返回true, 否则返回false
     */
    abstract public function clean();

}