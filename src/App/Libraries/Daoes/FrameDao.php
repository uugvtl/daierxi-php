<?php
namespace App\Libraries\Daoes;
use App\Frames\FrameSingle;
use App\Helpers\ArrayHelper;
use App\Helpers\JsonHelper;
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
abstract class FrameDao extends FrameSingle
{
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
