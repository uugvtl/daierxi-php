<?php
namespace App\Console\Generics\Initializes;
use App\Globals\Bases\BaseStore;
use App\Globals\Generics\BaseRepository;
use App\Globals\Stores\FormStore;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:48
 *
 * Class GenericRepository
 * @package App\Console\Generics\Initializes
 */
abstract class GenericRepository extends BaseRepository
{
    /**
     * @return BaseStore
     */
    final protected function createStoreInstance()
    {
        $injecter = $this->createSqlangInjecter();

        $cacheStore = FormStore::getInstance();
        $cacheStore->setSqlangInjecter($injecter);

        return $cacheStore;
    }
}