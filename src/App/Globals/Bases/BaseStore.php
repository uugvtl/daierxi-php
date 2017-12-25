<?php
namespace App\Globals\Bases;
use App\Injecters\StoreInjecter;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 16/8/30
 * Time: 16:29
 *
 * Class BaseStore
 * @package App\Globals\Bases
 */
abstract class BaseStore extends BaseSingle
{
    /**
     * @var StoreInjecter
     */
    private $storeInjecter;


    /**
     * @param StoreInjecter $injecter
     * @return $this
     */
    public function setStoreInjecter(StoreInjecter $injecter)
    {
        $this->storeInjecter = $injecter;
        return $this;
    }

    /**
     * @return StoreInjecter
     */
    public function getStoreInjecter()
    {
        return $this->storeInjecter;
    }

}