<?php
namespace App\Libraries\Cases\Daoes;
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
class RewzDao extends BaseDao
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