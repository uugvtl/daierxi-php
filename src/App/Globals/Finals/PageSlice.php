<?php
namespace App\Globals\Finals;
use App\Globals\Bases\BaseClass;
/**
 * 数据分段获取类--可以用于数组分段
 * User: leon
 * Date: 2016/7/28
 * Time: 10:46
 */

final class PageSlice extends BaseClass
{
    /**
     * 需要分段获取的数据总数
     * @var int
     */
    private $total;

    /**
     * 每段要获取的数据量
     * @var int
     */
    private $limit;

    /**
     * 需要获取的数据所在的分段
     * @var int
     */
    private $page;


    /**
     * 单例方法,用于访问实例的公共的静态方法:下面的注释不能取消
     * 返回此类的子类实例
     * @return static
     */
    public static function getInstance()
    {
        $me = new static();/* @var $me static */
        $paging = $me->getPagingParams();
        $me->page = $paging['page'];
        $me->limit = $paging['limit'];
        return $me;
    }

    /**
     * @param $total
     * @return PageSlice
     */
    public function setTotal($total)
    {
         $this->total = $total;
         return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    /**
     * 设置分页时，每页的记录数
     * @param int $limit
     * @return PageSlice
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * 获取每段要获取的数据量
     * @return int
     */
    public function getLimit()
    {
        return (int)$this->limit;
    }

    /**
     * 设置需要获取的数据所在的分段
     * @param int $page
     * @return PageSlice
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }


    /**
     * 获取需要获取的数据所在的分段
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * 设置并获取当前页下页的页码
     * @return int
     */
    public function nextPage()
    {
        $this->setPage($this->page+1);
        return $this->getPage();
    }

    /**
     * 设置并获取当前页前页的页码
     * @return int
     */
    public function prePage()
    {
        return $this->setPage($this->page-1)->getPage();
    }

    /**
     * 获取分段数量
     * @return int
     */
    public function getPageNumbers()
    {
        return ceil($this->total / $this->limit);
    }

    /**
     * 获取分页时的页码数与查询数据偏移量
     * @return int				    偏移量
     */
    public function getPageOffset()
    {
        $limit	= (int)$this->limit;
        $page	= (int)$this->page;

        $page	= 0>$page-1?0:$page-1;

        $offset = $page*$limit;
        return (int)$offset;
    }

    /**
     * 获取SQL的分页语句
     * @return string				分页的SQL语句
     */
    public function getPagingLimit()
    {
        $limit	= $this->getLimit();
        $offset = $this->getPageOffset();
        $paging = " LIMIT {$offset}, {$limit}";

        return $paging;
    }

    /**
     * 获取每个查询都需要用到的数据
     * @return array				提交的查询数据
     */
    protected function getPagingParams()
    {
        $params		= [
            'page'  =>0,
            'limit' =>25
        ];

        $page = isset($_GET['page'])?$_GET['page']:0;
        $limit= isset($_GET['limit'])?$_GET['limit']:25;

        $params['page']     = (int)$page;
        $params['limit']    = (int)$limit;
        return $params;
    }

}