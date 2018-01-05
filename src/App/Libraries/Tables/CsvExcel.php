<?php
namespace App\Libraries\Tables;
use App\Globals\Bases\BaseClass;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/19
 * Time: 14:10
 *
 * Class CsvExcel
 * @package App\Libraries\Tables
 */
class CsvExcel extends BaseClass
{
    /**
     * 需要导出的数据 二维数组
     * @var array
     */
    private $data;

    /**
     * 列标题名称
     * @var array
     */
    private $column;

    /**
     * 刷新缓冲区的上限数据记录数
     * @var int
     */
    private $limit;

    /**
     * 设置导出数据的文字编码
     * @var string
     */
    private $charset;

    /**
     * 导出的文件名
     * @var string
     */
    private $docname;

    /**
     * 是否发送到了客户端
     * @var bool
     */
    private $isSend;

    /**
     * 单例方法,用于访问实例的公共的静态方法:下面的注释不能取消
     * 返回此类的子类实例
     * @return static
     */
    public static function getInstance()
    {
        $me = new static();

        $me->charset = 'GBK';
        $me->docname = 'simple.csv';

        $me->afterInstance();
        return $me;
    }

    public function init(...$args)
    {
        $this->data = $args[0];
        return $this;
    }

    /**
     * @param string $docname
     * @return static
     */
    public function setDocname($docname)
    {
        $this->docname = $docname;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocname()
    {
        return  $this->docname;
    }

    /**
     * @param int $limit
     * @return static
     */
    public function setLimit($limit=100000)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * 设置导出的文字
     * @param string $charset
     * @return static
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * 设置标题
     * @param array $column
     * @return $this
     */
    public function setColumn(array $column){
        $this->column = $column;
        return $this;
    }


    /**
     * 输出数据
     * @return void
     */
    public function output()
    {
        $this->sendHeader();

        $fp = fopen('php://output', 'a');

        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小

        // 逐行取出数据，不浪费内存
        $count = count($this->data);

        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($this->limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = array_map(function($v){
                return iconv('UTF-8', $this->charset, $v);
            }, $this->data[$t]);

            fputcsv($fp, $row);
            unset($row);
        }


    }

    /**
     * 设置报头
     * @return static
     */
    private function sendHeader()
    {
        if(!$this->isSend)
        {
            $this->isSend=true;
            // 防止没有添加文件后缀
            $filename = str_replace('.csv', '', $this->docname).'.csv';
            ob_clean();
            header('Content-type: text/plain');
            header('Content-disposition: attachment;filename='.$filename);

            if ($this->column) {
                $fp = fopen('php://output', 'a');
                $title = array_map(function ($v) {
                    return iconv('UTF-8', $this->charset, $v);
                }, $this->column);
                fputcsv($fp, $title);
            }

        }
        return $this;
    }

}