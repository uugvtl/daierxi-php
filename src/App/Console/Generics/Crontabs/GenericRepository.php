<?php
namespace App\Console\Generics\Crontabs;
use App\Globals\Bases\BaseStore;
use App\Frames\Generics\FrameRepository;
use App\Globals\Stores\FormStore;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 14:48
 *
 * Class GenericRepository
 * @package App\Console\Generics\Crontabs
 */
abstract class GenericRepository extends FrameRepository
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