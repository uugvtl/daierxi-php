<?php
namespace App\Network\Generics\Queries;
use App\Globals\Bases\BaseStore;
use App\Globals\Generics\BaseRepository;
use App\Globals\Stores\SelectStore;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericRepository
 * @package App\Network\Generics\Queries
 */
abstract class GenericRepository extends BaseRepository
{
    /**
     * @return BaseStore
     */
    final protected function createStoreInstance()
    {
        $injecter = $this->createSqlangInjecter();

        $cacheStore = SelectStore::getInstance();
        $cacheStore->setSqlangInjecter($injecter);

        return $cacheStore;
    }

}