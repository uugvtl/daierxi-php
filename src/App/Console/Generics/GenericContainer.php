<?php
namespace App\Console\Generics;
use App\Frames\Generics\FrameContainer;
use App\Globals\Finals\Responder;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 02:30
 *
 * Class GenericContainer
 * @package App\Console\Generics
 */
class GenericContainer extends FrameContainer
{
    /**
     * @return Responder
     */
    public function get()
    {
        $service = $this->madeService();
        return $service->get();

    }
}