<?php
namespace App\Libraries\Daoes;
use App\Helpers\ArrayHelper;
use App\Helpers\JsonHelper;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Db;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/19
 * Time: 14:48
 *
 * Class BaseDao
 * @package App\Libraries\Cases\Daoes
 */
abstract class BaseDao extends Plugin
{

    /**
     * @var array 实例缓存
     */
    private static $_instanceCache=array();

    /**
     * 创建__clone方法防止对象被复制克隆
     */
    private function __clone(){}

    /**
     * SingleBase constructor.
     * protected标记的构造方法
     */
    private function __construct(){}


    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct(){}


    /**
     * 初始化,在实例生成之后运行
     */
    protected function afterInstance(){}

    /**
     * 单例方法,用于访问实例的公共的静态方法:下面的注释不能取消
     * 返回此类的子类实例
     * @return static
     */
    public static function getInstance()
    {
        $static = null;
        $className = get_called_class();

        if(isset(self::$_instanceCache[$className]))
        {
            $static = self::$_instanceCache[$className];
        }

        if(empty($static))
        {
            $static = new static();
            $static->setEventsManager($static->eventsManager);
            $static->onceConstruct();
            self::$_instanceCache[$className] = $static;
        }

        $static->afterInstance();
        return $static;
    }

    /**
     * 初始化模板方法，子类可以进行overload
     * @param array ...$args
     * @return static
     */
    public function init(...$args)
    {
        unset($args);
        return $this;
    }


    /**
     * 获取排序语句
     * @param string $aliasTable        表别名
     * @return string                   排序语句
     */
    public function getSortStmt($aliasTable='')
    {
        $stmt = $split = '';

        if($this->di->has('request'))
        {
            $request = $this->request;

            $sort = $request->getQuery('sort');
            $dir = $request->getQuery('dir');

            $jsonHelper = JsonHelper::getInstance();

            $sorts = $jsonHelper->decode($sort);
            if(json_last_error() == JSON_ERROR_NONE)
            {
                if(is_array($sorts))
                {

                    $arrayHelper = ArrayHelper::getInstance();
                    $stmt = $arrayHelper->reduce(function ($result, $rows) use (&$split) {
                        $result.= $split. " {$rows['property']} {$rows['direction']}";
                        $split = ',';
                        return $result;
                    }, $sorts, " ORDER BY ");
                }
            }
            else
            {
                if($sort && $dir)
                {
                    if($aliasTable) $aliasTable.='.';
                    $stmt = " ORDER BY {$aliasTable}{$sort} {$dir}";
                }
            }
        }

        return $stmt;
    }

    /**
     * PDO事务提交--删除数据
     * @param string|array    $sql  sql语句
     * @return int                  影响行数
     */
    abstract public function remove($sql);

    /**
     * 不带事务的删除
     * @param string|array $sql     sql语句
     * @return int                  影响行数
     */
    abstract public function delete($sql);

    /**
     * PDO事务提交--新增数据
     * @param string    $sql		        sql语句
     * @return int				            成功返回录入数据的id,否则0
     */
    abstract public function create($sql);

    /**
     * PDO事务提交
     * @param string|array  $sql            sql语句
     * @return int			                影响行数
     */
    abstract public function commit($sql);

    /**
     * 无事务的新增数据
     * @param string    $sql		        sql语句
     * @return int				            成功返回录入数据的id,否则0
     */
    abstract public function insert($sql);

    /**
     * @param string|array    $sql		    sql语句
     * @return int				            成功返回影响数量,否则0
     */
    abstract public function submit($sql);

    /**
     * 事务开始
     * @return bool
     */
    abstract public function start();

    /**
     * 事务完成
     * @return bool
     */
    abstract public function end();

    /**
     * 事务回滚
     * @return bool
     */
    abstract public function rollBack();


    /**
     * 从数据库获取一个数据
     * @param string $sql       SQL查询语句
     * @return mixed            单个数据,如果无数据则返回false
     * @return bool
     */
    abstract public function fetchOne($sql);

    /**
     * 获取数据，因为有时需要先查出数据再更新
     * @param string $sql
     * @param int $mode         数据结构方式:默认关联数据方式
     * @return array
     */
    abstract public function fetchRow($sql, $mode=Db::FETCH_ASSOC);

    /**
     *从数据库获取多条记录数据
     * @param string $sql       SQL查询语句
     * @param int $mode         数据结构方式:默认关联数据方式
     * @return array|boolean    一条记录数据,如果无数据则返回false
     */
    abstract public function fetchAll($sql, $mode=Db::FETCH_ASSOC);

}
