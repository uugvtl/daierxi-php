<?php
namespace App\Network\Modules\Manager\Common;
use App\Network\Modules\ModuleController;
use App\Network\Providers\ManagerContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 17:43
 *
 * Class ComController
 * @package App\Network\Modules\Manager\Common
 */
abstract class ComController extends ModuleController
{
    public function initialize()
    {
        $this->provider = ManagerContainerProvider::getInstance();
        $this->provider->init($this->createDistributer());
    }
}