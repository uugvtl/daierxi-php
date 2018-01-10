<?php
namespace App\Network\Generics\Removes;
use App\Frames\Generics\FrameService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 18:44
 *
 * Class GenericService
 * @package App\Network\Generics\Removes
 */
abstract class GenericService extends FrameService
{
    public function get()
    {
        $repository = $this->madeRepositoryInstance();
        $logic = $this->madeLogicInstance();
        return $logic->init($repository)->get();
    }
}
