<?php
namespace App\Interfaces\Generics;
use App\Globals\Finals\Responder;
use App\Interfaces\IRunnable;
/**
 * Interface IRespondable
 * @package App\Interfaces\Generics
 */
interface IRespondable extends IRunnable
{
    /**
     * @return Responder
     */
    public function run();
}