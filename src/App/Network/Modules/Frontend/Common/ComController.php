<?php
namespace App\Network\Modules\Frontend\Common;
use App\Network\Modules\ModuleController;
use App\Network\Providers\FrontendContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 17:41
 *
 * Class ComController
 * @package App\Network\Modules\Frontend\Common
 */
abstract class ComController extends ModuleController
{
    public function initialize()
    {
        $this->provider = FrontendContainerProvider::getInstance();
        $this->provider->init($this->createDistributer());
    }
}