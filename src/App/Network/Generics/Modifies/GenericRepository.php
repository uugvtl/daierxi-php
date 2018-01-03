<?php
namespace App\Network\Generics\Modifies;
use App\Globals\Bases\BaseStore;
use App\Frames\Generics\FrameRepository;
use App\Globals\Stores\FormStore;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:08
 *
 * Class GenericRepository
 * @package App\Network\Generics\Creates
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