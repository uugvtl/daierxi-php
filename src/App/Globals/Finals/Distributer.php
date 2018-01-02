<?php
namespace App\Globals\Finals;
use App\Globals\Bases\BaseClass;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/12/17
 * Time: 15:17
 *
 * Class DistributerHelper
 * @package App\Helpers
 */
final class Distributer extends BaseClass
{
    /**
     * 控制器名称
     * @var string
     */
    private $ctrlString;

    /**
     * 动用方法名称
     * @var string
     */
    private $actString;

    /**
     * 不带有命名空间的类名称
     * @var string
     */
    private $prefixString;

    /**
     * 手动初始化
     * @param array ...$args
     * @return $this
     */
    public function init(...$args)
    {
        $this->ctrlString   = $args[0];
        $this->actString    = $args[1];
        $this->prefixString = $args[2];

        return $this;
    }

    /**
     * 获取命名空间路径
     * @return string
     */
    public function getPath()
    {
        $ctrlName   = $this->getClassName($this->ctrlString);
        $actName    = $this->getClassName($this->actString);
        $fileName   = $this->getClassName($this->prefixString);

        $namespace = $ctrlName.BACKSLASH.$actName.BACKSLASH.$fileName;

        return $namespace;
    }

    /**
     * @param $ctrlString
     * @return $this
     */
    public function setCtrlString($ctrlString)
    {
        $this->ctrlString = $ctrlString;
        return $this;
    }

    public function getCtrlString()
    {
        return $this->ctrlString;
    }

    /**
     * @param $actString
     * @return $this
     */
    public function setActString($actString)
    {
        $this->actString = $actString;
        return $this;
    }


    public function getActString()
    {
        return $this->actString;
    }

    /**
     * 设置导出文件名
     * @param string $prefixString
     * @return $this
     */
    public function setPrefixString($prefixString)
    {
        $this->prefixString = $prefixString;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefixString()
    {
        return $this->prefixString;
    }

    /**
     * 获取dispatch过来的类名称
     * @param string $className     带有-或是_类名称
     * @return string               返回passcal类名称
     */
    private function getClassName($className)
    {
        $className = str_replace('_', ' ', $className);
        $className = str_replace('-', ' ', $className);
        $className = str_replace(' ', '', ucwords($className));
        $className = ucwords(str_replace(BACKSLASH, ' ', $className));
        return str_replace(' ', BACKSLASH, $className);

    }
}