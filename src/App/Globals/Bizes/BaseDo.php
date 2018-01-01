<?php
namespace App\Globals\Bizes;
use App\Globals\Bases\BaseBiz;
use App\Libraries\Daoes\AppDao;
use App\Libraries\Daoes\FrameDao;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 19:53
 *
 * Class BaseDo
 * @package App\Globals\Bizes
 */
abstract class BaseDo extends BaseBiz
{
    /**
     * @var FrameDao
     */
    private $dao;

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
     * 删除数据从库，无事务更新操作
     * @return $this
     */
    abstract public function delete();

    /**
     * 获取主键，如果是数组的形式的话返回的是serialize后的数组
     * @return mixed
     */
    abstract public function primaryKey();

    protected function afterInstance()
    {
        parent::afterInstance();
        $this->dao = AppDao::getInstance();
    }

    /**
     * @return FrameDao
     */
    protected function getDao()
    {
        return $this->dao;
    }


}