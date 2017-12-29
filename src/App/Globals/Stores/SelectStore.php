<?php
namespace App\Globals\Stores;
use App\Globals\Bases\BaseStore;
use App\Helpers\FileHelper;
use App\Libraries\Caches\FileCache;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/8/17
 * Time: 03:24
 *
 * Class SelectStore
 * @package App\Globals\Stores
 */
abstract class SelectStore extends BaseStore
{
    public function init(...$args)
    {
        $total = (int)$args[0];
        $this->getStoreInjecter()->getPageInstance()->setTotal($total);
        return $this;
    }

    /**
     * 只在生成成实例的时候运行一次
     */
    protected function onceConstruct()
    {
        $fileHelper = FileHelper::getInstance();

        $cacheInstance = require INJECT_PATH .'/cache.php';
        $this->cache = FileCache::getInstance();
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