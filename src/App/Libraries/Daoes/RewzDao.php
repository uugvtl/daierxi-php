<?php
namespace App\Libraries\Daoes;
use PDO;
use Phalcon\Db;
use Phalcon\Db\AdapterInterface;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/6/1
 * Time: 14:18
 *
 * Class RewzDao
 * @package App\Libraries\Cases\Daoes
 */
class RewzDao extends FrameDao
{
    /**
     * @var AdapterInterface
     */
    protected $rewz;


    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct()
    {
        $this->rewz = require INJECT_PATH . '/rewz.php';
    }

    /**
     * PDO事务提交--删除数据
     * @param string|array    $sql  sql语句
     * @return int                  影响行数
     */
    public function remove($sql)
    {
        $numbers = 0;

        if(is_string($sql))
        {
            $this->rewz->begin();
            $this->rewz->execute($sql);
            $numbers = $this->rewz->affectedRows();
            $this->rewz->commit();
        }

        if(is_array($sql))
        {
            $this->rewz->begin();

            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->rewz->execute($s);
                    $numbers+= $this->db->affectedRows();
                }
            }
            $this->rewz->commit();

        }

        return $numbers;
    }

    /**
     * 不带事务的删除
     * @param string|array $sql     sql语句
     * @return int                  影响行数
     */
    public function delete($sql)
    {
        $numbers = 0;

        if(is_string($sql))
        {
            $this->rewz->execute($sql);
            $numbers = $this->rewz->affectedRows();
        }

        if(is_array($sql))
        {
            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->rewz->execute($s);
                    $numbers+= $this->db->affectedRows();
                }
            }

        }

        return $numbers;
    }

    /**
     * PDO事务提交--新增数据
     * @param string    $sql		        sql语句
     * @return int				            成功返回录入数据的id,否则0
     */
    public function append($sql)
    {

        $lastId = 0;

        if($sql)
        {
            $this->rewz->begin();

            $this->rewz->execute($sql);
            $lastId = $this->rewz->lastInsertId();

            $this->rewz->commit();
        }

        return $lastId;
    }

    /**
     * PDO事务提交
     * @param string|array  $sql            sql语句
     * @return int			                影响行数
     */
    public function commit($sql)
    {

        $numbers = 0;

        if(is_string($sql))
        {
            $this->rewz->begin();
            $this->rewz->execute($sql);
            $numbers = $this->rewz->affectedRows();
            $this->rewz->commit();
        }

        if(is_array($sql))
        {
            $this->rewz->begin();

            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->rewz->execute($s);
                    $numbers+= $this->db->affectedRows();
                }
            }
            $this->rewz->commit();

        }

        return $numbers;

    }

    /**
     * 无事务的新增数据
     * @param string    $sql		        sql语句
     * @return int				            成功返回录入数据的id,否则0
     */
    public function insert($sql)
    {
        $this->rewz->execute($sql);
        $lastId = $this->rewz->lastInsertId();

        return $lastId;
    }

    /**
     * @param string|array    $sql		    sql语句
     * @return int				            成功返回影响数量,否则0
     */
    public function submit($sql)
    {

        $numbers = 0;

        if(is_string($sql))
        {
            $this->rewz->execute($sql);
            $numbers = $this->rewz->affectedRows();
        }

        if(is_array($sql))
        {
            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->rewz->execute($s);
                    $numbers+= $this->db->affectedRows();
                }
            }

        }

        return $numbers;
    }

    /**
     * 事务开始
     * @return bool
     */
    public function start()
    {
        return $this->rewz->begin();
    }

    /**
     * 事务完成
     * @return bool
     */
    public function end()
    {
        return $this->rewz->commit();
    }

    /**
     * 事务回滚
     * @return bool
     */
    public function rollBack()
    {
        return $this->rewz->rollback();
    }

    public function autocommit($auto=true)
    {
        $auto = (bool)$auto;
        $this->rewz->getInternalHandler()->setAttribute(PDO::ATTR_AUTOCOMMIT, $auto);
        return $this;
    }

    /**
     * 从数据库获取一个数据
     * @param string $sql       SQL查询语句
     * @return mixed            单个数据,如果无数据则返回false
     * @return bool
     */
    public function fetchOne($sql)
    {
        $data = false;
        $rows = $this->rewz->fetchOne($sql, Db::FETCH_NUM);
        if($rows) $data = $rows[0];
        return is_null($data) ? false : $data ;
    }

    /**
     * 获取数据，因为有时需要先查出数据再更新
     * @param string $sql
     * @param int $mode         数据结构方式:默认关联数据方式
     * @return array
     */
    public function fetchRow($sql, $mode=Db::FETCH_ASSOC)
    {
        $rows = $this->rewz->fetchOne($sql, $mode);
        return $rows ? $rows : array();
    }

    /**
     *从数据库获取多条记录数据
     * @param string $sql       SQL查询语句
     * @param int $mode         数据结构方式:默认关联数据方式
     * @return array|boolean    一条记录数据,如果无数据则返回false
     */
    public function fetchAll($sql, $mode=Db::FETCH_ASSOC)
    {
        $records = $this->rewz->fetchAll($sql, $mode);
        return $records ? $records:array();
    }
}