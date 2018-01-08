<?php
namespace App\Globals\Traits;
use function count;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 13:18
 *
 * Trait PersistentTait
 * @package App\Globals\Traits
 */
trait PersistentTait
{
    /**
     * 处理
     * @param array $toggles
     * @return bool
     */
    protected function batchPersistent(array $toggles)
    {
        $target = count($toggles);
        $source = 0;
        foreach ($toggles as $toggle)
        {
            $temp = (bool)$toggle;
            YES===$temp && $source++;
        }
        return $target===$source ? YES:NO;
    }
}