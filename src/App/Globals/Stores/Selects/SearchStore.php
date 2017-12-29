<?php
namespace App\Globals\Stores\Selects;
use App\Globals\Stores\SelectStore;
use App\Helpers\FileHelper;
use App\Libraries\Caches\NotCache;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/20
 * Time: 11:41
 *
 * Class GlobalConsoleStore
 * @package App\Globals\Stores
 */
class SearchStore extends SelectStore
{
    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct()
    {
        $fileHelper = FileHelper::getInstance();

        $cacheInstance = require INJECT_PATH .'/cache.php';
        $this->cache = NotCache::getInstance();
        $this->cache->init($cacheInstance);
        /* 生成后台文件缓存目录--以类名作为目录名 BEGIN */
        $className      = get_called_class();
        $classNameDir   = str_replace('\\', '/', $className).'/';
        $cacheDir       = GENERAL_CACHE_DIR.$classNameDir;
        $fileHelper->createDir($cacheDir);
        $cacheInstance->setOptions(array(
            'cacheDir'  => $cacheDir
        ));
        /* 生成后台文件缓存目录--类名作为目录名 END */
    }

}