<?php
namespace App\Network\Modules;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Interfaces\Providers\INetworkContainerProvider;
use App\Network\Common\NetController;
use Phalcon\Mvc\Dispatcher;
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
     * 获取相关的 Distributer
     * @param Dispatcher $dispatcher
     * @return Distributer
     */
    final public function madeDistributer(Dispatcher $dispatcher)
    {
        $distributer = Distributer::getInstance();

        $ctrlName   = $dispatcher->getControllerName();
        $actName    = $dispatcher->getActionName();
        $fileName   = ClassConst::CLASS_PREFIX;

        $distributer->init($ctrlName, $actName, $fileName);

        return $distributer;
    }

}