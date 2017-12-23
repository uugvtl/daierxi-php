<?php
namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/11
 * Time: 16:24
 *
 * Class CSqlHelper
 */
class CSqlHelper extends CBaseHelper
{
    /**
     * 生成 INSERT INTO 这样的语句
     * @var int
     */
    const SQL_CREATE_INSERT = 1;

    /**
     * 生成 INSERT IGNORE INTO 这样的语句
     * @var int
     */
    const SQL_CREATE_IGNORE = 2;

    /**
     * 生成 REPLACE INTO 这样的语句
     * @var int
     */
    const SQL_CREATE_REPLACE = 3;

    /**
     * 生成纯数字生的主键
     * @return string
     */
    public function createPrimaryKey()
    {
        return date("YmdHis") . str_pad(rand(0, 99), 2, 0, STR_PAD_LEFT);
    }

    /**
     * 获取订单编号
     * @return string 订单编号--长度为19
     */
    public function createOrderSn()
    {
        //哪年,哪天,哪一秒
        $orderSn = date('Ymd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $orderSn;
    }

    /**
     * 是否为有效字符串
     * @param array $condz      数组数据
     * @param string $key       数组的键名
     * @return bool             有效为true,否则为false
     */
    public function is_string(array $condz, $key)
    {
        return !empty($condz[$key]) && is_string($condz[$key]);
    }

    /**
     * 判断变量是否为数字
     * @param array $condz      数组数据
     * @param string $key       数组的键名
     * @return bool             数字为true,否则为false
     */
    public function is_numeric(array $condz, $key)
    {
        return isset($condz[$key]) && is_numeric($condz[$key]);
    }

    /**
     * 判断变量是否为数字且大于零
     * @param array $condz      数组数据
     * @param string $key       数组的键名
     * @return bool             数字为true,否则为false
     */
    public function is_numeric_positive(array $condz, $key)
    {
        $toggle = false;
        if(isset($condz[$key]) && is_numeric($condz[$key]))
        {
            $condz[$key]>0 && $toggle  = true;
        }

        return $toggle;
    }

    /**
     * 判断是否为以,号分隔的id列表
     * @param array $condz      数组数据
     * @param string $key       数组的键名
     * @return bool             是返回true,否则返回false
     */
    public function is_comma_ids(array $condz, $key)
    {
        return !empty($condz[$key]) && count(explode(',', $condz[$key]));
    }

    /**
     * 数组中是否包括指定键名
     * @param array $condz      数组数据，键值对
     * @param string $key       键名
     * @return bool             是返回true,否则返回false
     */
    public function is_valid(array $condz, $key)
    {
        return !empty($condz[$key]);
    }

    /**
     * 是否是列表
     * @param array $condz      数组数据，键值对
     * @param string $key       键名
     * @return bool             是返回true,否则返回false
     */
    public function is_list(array $condz, $key)
    {
        return !empty($condz[$key]) && is_array($condz[$key]);
    }


    /**
     * 获取表名称
     * @param string $table     数据表名称
     * @param string $prefix    数据表前辍
     * @return string
     */
    public function getTableName($table, $prefix='vz_')
    {
        return $prefix.$table;
    }

    /**
     * 获取以半角逗号分隔且每个元素都经过转义如 'a','b'
     * @param array $rows       一组元素列表
     * @return string           合成后的字符串
     */
    public function getSplitQuote(array $rows)
    {
        $str = '';

        if($rows)
        {
            $rows   = array_map(array('CStringHelper', 'htmlEncode'), $rows);
            $rows   = array_map(array('CStringHelper', 'quoteValue'), $rows);
            $str    = implode(',', $rows);
        }

        return $str;
    }


    /**
     * 生成查询SQL语句
     * @param string $fields        需要获取的字段
     * @param string $table         相关的表名称，可以是多表关联
     * @param string $where         相关的查询条件
     * @return string               sql语句
     */
    public function getSelectString($fields, $table, $where)
    {
        $sql = "SELECT
                    {$fields}
                FROM
                    {$table}
                WHERE
                    1=1 {$where};\n";
        return $sql;
    }

    /**
     * 生成新增SQL语句
     * @param array $params         需要保存进数据库的字段,key为字段名，value为相对应的值
     * @param string $table         相关的表名称，可以是多表关联
     * @param int   $mode           插入模式，1:普通，2:忽略主键，3:REPLACE模式
     * @return string               sql语句
     */
    public function getCreateString(array $params, $table, $mode=CSqlHelper::SQL_CREATE_INSERT)
    {
        $insert = " INSERT INTO ";

        $aInsert = array(
            CSqlHelper::SQL_CREATE_INSERT       => " INSERT INTO ",
            CSqlHelper::SQL_CREATE_IGNORE       => " INSERT IGNORE INTO ",
            CSqlHelper::SQL_CREATE_REPLACE      => " REPLACE INTO "
        );

        $insert = isset($aInsert[$mode])?$aInsert[$mode]:$insert;

        $fields = $this->getEscapeSql($params);
        $sql = "{$insert} {$table} SET {$fields};\n";

        return $sql;
    }

    /**
     * 生成更新SQL语句
     * @param array     $params         需要保存进数据库的字段,key为字段名，value为相对应的值
     * @param string    $table          相关的表名称，可以是多表关联
     * @param string    $where          相关的查询条件
     * @param array     $subjoin        不需要进行转义的字段
     * @return string                   sql语句
     */
    public function getUpdateString(array $params, $table, $where, $subjoin=[])
    {
        $fields = $this->getUpdateSql($params, $subjoin);

        $sql = "UPDATE 
                    {$table}
                SET
                    {$fields}
                WHERE
                    1=1 {$where};\n";
        return $sql;
    }

    /**
     * 生成删除语句
     * @param string $table         相关的表名称，可以是多表关联
     * @param string $where         相关的查询条件
     * @param string $alias         关联表别名
     * @return string               sql语句
     */
    public function getDeleteString($table, $where, $alias='')
    {
        $sql = "DELETE {$alias} FROM {$table} WHERE 1=1 {$where};\n";
        return $sql;
    }

    /**
     * 获取SQL语句在更新或新增时的SET写法语句
     * @param array $params                 需要更新或是新增的数据key,value键值对
     * @param array $original               不需要进行转义的字段
     * @return string                       sql语句
     */
    public function getUpdateSql(array $params, $original=[])
    {
        $fields = $this->getEscapeSql($params);

        if($fields)
        {
            $original && $fields .= ','.$this->getOriginalSql($original);
        }
        else
        {
            $fields = $this->getOriginalSql($original);
        }

        return $fields;
    }

    /**
     * 获取SQL语句在新增时的SET写法语句
     * @param array $rows               需要更新或是新增的数据key,value键值对
     * @return string                   SQL的SET写法语句
     */
    public function getOriginalSql(array $rows)
    {

        $stmt = $split = "";
        foreach($rows as $k=>$v)
        {
            $stmt.= $split."{$k}={$v}";
            $split = ",";
        }

        return $stmt;
    }

    /**
     * 获取SQL语句在更新或新增时的SET写法语句
     * @param array $rows               需要更新或是新增的数据key,value键值对
     * @return string                   SQL的SET写法语句
     */
    public function getEscapeSql(array $rows)
    {

        $rows       = array_map(array('CStringHelper', 'htmlEncode'), $rows);
        $aQuoteRows = array_map(array('CStringHelper', 'quoteValue'), $rows);

        $stmt = $split = "";
        foreach($aQuoteRows as $k=>$v)
        {
            $stmt.= $split."{$k}={$v}";
            $split = ",";
        }

        return $stmt;

    }

    /**
     * 生成相关字段递增值的SQL语句
     *
     * @param array $rows                   需要递增的数据
     * @param string $tableName             表名称
     * @param string $where                 过滤查询条件
     * @return string                       sql语句
     */
    public function getIncreaseSQL(array $rows, $tableName, $where)
    {
        $rows         = array_map(array('CStringHelper', 'htmlEncode'), $rows);
        $aQuoteRows   = array_map(array('CStringHelper', 'quoteValue'), $rows);

        $stmt = $split = "";
        foreach($aQuoteRows as $k=>$v)
        {
            $stmt.= $split."{$k}={$k}+{$v}";
            $split = ",";
        }

        if(empty($where))
            $where.= " AND FALSE";

        return "UPDATE {$tableName} SET {$stmt} WHERE 1=1 {$where};\n";
    }

    /**
     * 生成相关字段递减值的SQL语句
     *
     * @param array $rows                   需要递减数据
     * @param string $tableName             表名称
     * @param string $where                 过滤查询条件
     * @return string                       sql语句
     */
    public function getDecreaseSQL(array $rows, $tableName, $where)
    {
        $rows         = array_map(array('CStringHelper', 'htmlEncode'), $rows);
        $aQuoteRows   = array_map('floatval', $rows);

        $stmt = $split = "";
        foreach($aQuoteRows as $k=>$v)
        {
            $stmt.= $split."{$k}={$k}-{$v}";
            $split = ",";
        }

        if(empty($where))
            $where.= " AND FALSE";

        return "UPDATE {$tableName} SET {$stmt} WHERE 1=1 {$where};\n";
    }

    /**
     * 获取SQL语句的fields语句
     * @param array $rows       字段列表
     * @return string           SQL的fields语句
     */
    protected function getFieldsSql(array $rows)
    {
        return implode(',', $rows);
    }


    /**
     * 获取分页时的页码数与查询数据偏移量
     * @param int $page				页码数
     * @param int $limit			每页记录数
     * @return int				    偏移量
     */
    protected function getPageOffset($page, $limit)
    {
        $limit	= (int)$limit;
        $page	= (int)$page;

        $page	= 0>$page-1?0:$page-1;

        $offset = $page*$limit;
        return (int)$offset;
    }
}
