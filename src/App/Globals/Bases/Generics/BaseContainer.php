<?php
namespace App\Globals\Bases\Generics;
use App\Globals\Bases\BaseGeneric;
use App\Globals\Bases\Distributers\BaseService;
use App\Interfaces\IRunnable;
use App\Libraries\Creator;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 02:09
 *
 * Class BaseContainer
 * @package App\Globals\Bases\Generics
 */
abstract class BaseContainer extends BaseGeneric implements IRunnable
{
    protected function createService()
    {
        $this->getGenericInjecter()->getDistributer()->getPath();
        Creator::make('', BaseService::class);
    }
}