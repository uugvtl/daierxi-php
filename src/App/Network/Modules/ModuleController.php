<?php
namespace App\Network\Modules;
use App\Datesets\DataConst;
use App\Globals\Finals\Distributer;
use App\Interfaces\Providers\INetworkContainerProvider;
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
     * @var INetworkContainerProvider
     */
    protected $provider;

    /**
     * @return Distributer
     */
    final protected function createDistributer()
    {
        $dispatcher = $this->dispatcher;
        $distributer = Distributer::getInstance();

        $ctrlName   = $dispatcher->getControllerName();
        $actName    = $dispatcher->getActionName();
        $fileName   = DataConst::CLASS_PREFIX;

        $distributer->init($ctrlName, $actName, $fileName);

        return $distributer;
    }

}