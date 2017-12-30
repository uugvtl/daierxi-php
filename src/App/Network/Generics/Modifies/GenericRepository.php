<?php
namespace App\Network\Generics\Modifies;
use App\Globals\Bases\BaseStore;
use App\Globals\Generics\BaseRepository;
use App\Globals\Stores\Selects\SearchStore;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:08
 *
 * Class GenericRepository
 * @package App\Network\Generics\Creates
 */
abstract class GenericRepository extends BaseRepository
{
    /**
     * @return BaseStore
     */
    protected function createStoreInstance()
    {
        $injecter = $this->createSqlangInjecter();

        $cacheStore = SearchStore::getInstance();
        $cacheStore->setSqlangInjecter($injecter);

        return $cacheStore;
    }
}