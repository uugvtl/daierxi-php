<?php
namespace App\Libraries\Daoes;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/19
 * Time: 14:48
 *
 * Class ExecuteDao
 * @package App\Libraries\Cases
 */
class FormDao extends BaseDao
{
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
            $this->db->begin();
            $this->db->execute($sql);
            $numbers = $this->db->affectedRows();
            $this->db->commit();
        }

        if(is_array($sql))
        {
            $this->db->begin();

            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->db->execute($s);
                }
            }
            $numbers = $this->db->affectedRows();
            $this->db->commit();

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
            $this->db->execute($sql);
            $numbers = $this->db->affectedRows();
        }

        if(is_array($sql))
        {
            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->db->execute($s);
                }
            }
            $numbers = $this->db->affectedRows();

        }

        return $numbers;
    }

    /**
     * PDO事务提交--新增数据
     * @param string    $sql		        sql语句
     * @return int				            成功返回录入数据的id,否则0
     */
    public function create($sql)
    {

        $lastId = 0;

        if($sql)
        {
            $this->db->begin();

            $this->db->execute($sql);
            $lastId = $this->db->lastInsertId();

            $this->db->commit();
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
            $this->db->begin();
            $this->db->execute($sql);
            $numbers = $this->db->affectedRows();
            $this->db->commit();
        }

        if(is_array($sql))
        {
            $this->db->begin();

            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->db->execute($s);
                }
            }
            $numbers = $this->db->affectedRows();
            $this->db->commit();

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
        $this->db->execute($sql);
        $lastId = $this->db->lastInsertId();

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
            $this->db->execute($sql);
            $numbers = $this->db->affectedRows();
        }

        if(is_array($sql))
        {
            foreach ($sql as $s)
            {
                if($s)
                {
                    $this->db->execute($s);
                }
            }

            $numbers = $this->db->affectedRows();

        }

        return $numbers;
    }

    /**
     * 事务开始
     * @return bool
     */
    public function start()
    {
        return $this->db->begin();
    }

    /**
     * 事务完成
     * @return bool
     */
    public function end()
    {
        return $this->db->commit();
    }

    /**
     * 事务回滚
     * @return bool
     */
    public function rollBack()
    {
        return $this->db->rollback();
    }


}