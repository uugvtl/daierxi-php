<?php
use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;
// Cache the files for 2 days using a Data frontend
$frontCache = new FrontData(array(
    "lifetime" => CACHE_LIFETIME
));

// Create the component that will cache "Data" to a "File" backend
// Set the cache file directory - important to keep the "/" at the end of
// of the value for the folder
$cache = new BackFile($frontCache, array(
    'cacheDir' => GENERAL_CACHE_DIR
));
$cache->useSafeKey(true);

/**
 * 返回缓存对象实例
 * @return BackFile;
 */
return $cache;