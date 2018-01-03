<?php
namespace App\Network\Generics\Removes;
use App\Globals\Bases\BaseStore;
use App\Frames\Generics\FrameRepository;
use App\Globals\Stores\FormStore;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:49
 *
 * Class GenericRepository
 * @package App\Network\Generics\Removes
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