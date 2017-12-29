<?php
namespace App\Network\Modules\Frontend\Generics\Queries\Repositories;
use App\Globals\Finals\Responder;
use App\Network\Generics\Queries\GenericRepository;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 01:51
 *
 * Class QueryRepository
 * @package App\Network\Modules\Manager\Generics\Queries\Repositories
 */
class QueryRepository extends GenericRepository
{
    public function run()
    {
//        $store = $this->createStoreInstance();
        return Responder::getInstance();
    }

//    /**
//     * 获取同一查询条件下的数据列表
//     * @return array
//     */
//    protected function getList()
//    {
//        return [];
//    }
//
//    /**
//     * 获取同一查询条件下的数据总数
//     * @return int
//     */
//    protected function getCount()
//    {
//        return 0;
//    }
//
//    /**
//     * 获取符合条件的记录总数据--如果已经查询过，就不存查询，直接读取缓存
//     * @return int
//     */
//    protected function getTotal()
//    {
//        return 0;
//    }




}