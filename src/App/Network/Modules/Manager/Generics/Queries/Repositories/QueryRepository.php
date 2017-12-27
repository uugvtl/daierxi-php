<?php
namespace App\Network\Modules\Manager\Generics\Queries\Repositories;
use App\Creators\BaseCreator;
use App\Creators\Generics\Queries\LogicCreator;
use App\Globals\Bases\Generics\BaseRepository;
use App\Network\Modules\Manager\Generics\Queries\Logics\QueryLogic;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 01:51
 *
 * Class QueryRepository
 * @package App\Network\Modules\Manager\Generics\Queries\Repositories
 */
class QueryRepository extends BaseRepository
{
    /**
     * @var BaseCreator
     */
    private $logicCreator;


    public function run()
    {
        $this->logicCreator = LogicCreator::getInstance();
        $this->logicCreator->init($this->getGenericInjecter());

        $logic = $this->logicCreator->create(QueryLogic::class);
        $logic->run();
    }

    /**
     * 获取同一查询条件下的数据列表
     * @return array
     */
    protected function getList()
    {
        return [];
    }

    /**
     * 获取同一查询条件下的数据总数
     * @return int
     */
    protected function getCount()
    {
        return 0;
    }

    /**
     * 获取符合条件的记录总数据--如果已经查询过，就不存查询，直接读取缓存
     * @return int
     */
    protected function getTotal()
    {
        return 0;
    }

}