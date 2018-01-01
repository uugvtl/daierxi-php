<?php
namespace App\Interfaces\Generics;
use App\Globals\Finals\Responder;
use App\Interfaces\IGetable;
/**
 * Interface IRespondable
 * @package App\Interfaces\Generics
 */
interface IRespondable extends IGetable
{
    /**
     * @return Responder
     */
    public function get();
}