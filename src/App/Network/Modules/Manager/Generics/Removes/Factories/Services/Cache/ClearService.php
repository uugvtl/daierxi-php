<?php
namespace App\Network\Modules\Manager\Generics\Removes\Factories\Services\Cache;
use App\Globals\Finals\Responder;
use App\Helpers\FileHelper;
use App\Network\Modules\Manager\Generics\Removes\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 21:49
 *
 * Class ClearService
 * @package App\Network\Modules\Manager\Generics\Removes\Factories\Services\Cache
 */
class ClearService extends AppService
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