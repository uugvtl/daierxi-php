<?php
namespace App\Globals\Finals;
use App\Globals\Bases\BaseClass;
use App\Helpers\ArrayHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 17/11/17
 * Time: 21:20
 *
 * Class Parameter
 * @package App\Globals
 */
final class Parameter extends BaseClass
{
    private $params = [];

    /**
     * 初始化参数
     * @param array $args
     * @return $this
     */
    public function init(...$args)
    {
        $this->params = $args[0];
        return $this;
    }

    /**
     * 合并参数
     * @param array $params         需要合并的参数
     * @return static
     */
    public function merge(array $params)
    {
        $arrayHelper = ArrayHelper::getInstance();
        $this->params = $arrayHelper->mergeArray($this->params, $params);
        return $this;
    }


    /**
     * 设置相关属性值
     * @param string $key           属性名称
     * @param mixed $value          属性值
     * @return static
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * 获取参数
     * @return array
     */
    public function get()
    {
        return $this->params;
    }

    /**
     * 判断参数是否存在
     * @param string $key           属性名称
     * @return bool                 判断是否存在指定的参数，存在返回true,否则返回false
     */
    public function has($key)
    {
        return isset($this->params[$key]);
    }

    /**
     * 获取指定的参数值
     * @param string $key           属性名称
     * @return mixed                属性值
     */
    public function getValue($key)
    {
        return $this->has($key) ? $this->params[$key]:null;
    }

    /**
     * 指定的键名是否有效值
     * @param string $key           属性名称
     * @return bool                 判断是否存在指定的参数，存在返回true,否则返回false
     */
    public function isValid($key)
    {
        return !empty($this->params[$key]);
    }
}