<?php
namespace App\Libraries\Caches\Dependencies;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 21:17
 *
 * Class NotCacheDependency
 * @package App\Libraries\Caches\Dependencies
 */
class NotCacheDependency extends BaseCacheDependency
{
    /**
     * Generates the data needed to determine if dependency has been changed.
     * This method returns the file's last modification time.
     * @return mixed the data needed to determine if dependency has been changed.
     */
    protected function generateDependentData()
    {
        return true;
    }
}