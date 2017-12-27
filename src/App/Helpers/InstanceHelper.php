<?php
namespace App\Helpers;
use App\Globals\Bases\BaseSingle;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 02:17
 *
 * Class InstanceHelper
 * @package App\Helpers
 */
class InstanceHelper extends BaseSingle
{
    /**
     * 新建类实例
     * @param string $hits          类型提示，例如BaseCreator::class 这样
     * @param string $classname     类的全名，可以使用 BaseCreator::class 或是字符串拼接的类全名
     * @param array ...$args        初始化参数
     * @return mixed
     */
    public function build($hits, $classname, ...$args)
    {
        unset($hits);
        $instance = call_user_func([$classname, 'getInstance']);
        return $instance->init($args);
    }
}