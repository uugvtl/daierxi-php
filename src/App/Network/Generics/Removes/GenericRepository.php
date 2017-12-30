<?php
namespace App\Network\Generics\Removes;
use App\Globals\Bases\BaseStore;
use App\Globals\Generics\BaseRepository;
use App\Globals\Stores\Selects\CacheStore;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericRepository
 * @package App\Network\Generics\Removes
 */
abstract class GenericRepository extends BaseRepository
{
    /**
     * @return BaseStore
     */
    protected function createStoreInstance()
    {
        $injecter = $this->createSqlangInjecter();

        $cacheStore = CacheStore::getInstance();
        $cacheStore->setSqlangInjecter($injecter);

        return $cacheStore;
    }

}