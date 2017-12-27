<?php
namespace App\Network\Modules;
use App\Interfaces\Providers\INetContainerProvider;
use App\Network\Common\NetController;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:08
 *
 * Class ModuleController
 * @package App\Network\Modules
 */
abstract class ModuleController extends NetController
{
    /**
     * @var INetContainerProvider
     */
    protected $provider;
}