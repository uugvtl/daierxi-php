<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Services\Cache\Clear;
use App\Globals\Finals\Responder;
use App\Helpers\FileHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Services\RemoveService;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 13:01
 *
 * Class DefaultService
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Services\Cache\Clear
 */
class DefaultService extends RemoveService
{
    public function get()
    {
        $fileHelper = FileHelper::getInstance();
        $fileHelper->removeDirectory(DEPENDENCY_CACHE_DIR);
        if(function_exists('opcache_reset')){
            opcache_reset();
        }

        $responder =  Responder::getInstance();
        $responder->toggle = YES;
        $responder->msg = $this->t('global', 'cache_claer');

        return $responder;
    }
}