<?php
namespace App\Network\Generics;
use App\Frames\Generics\FrameContainer;
use App\Globals\Finals\Responder;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 02:15
 *
 * Class GenericContainer
 * @package App\Network\Generics
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