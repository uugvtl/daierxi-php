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
    private $ctrlName;

    /**
     * 动用方法名称
     * @var string
     */
    private $actName;

    /**
     * 不带有命名空间的类名称
     * @var string
     */
    private $fileName;

    /**
     * 手动初始化
     * @param array ...$args
     * @return $this
     */
    public function init(...$args)
    {
        $this->ctrlName = $args[0];
        $this->actName  = $args[1];
        $this->fileName = $args[2];

        return $this;
    }

    /**
     * 获取命名空间路径
     * @return string
     */
    public function getPath()
    {
        $ctrlName   = $this->getClassName($this->ctrlName);
        $actName    = $this->getClassName($this->actName);
        $fileName   = $this->getClassName($this->fileName);

        $namespace = $ctrlName.BACKSLASH.$actName.BACKSLASH.$fileName;

        return $namespace;
    }

    /**
     * @param $ctrlName
     * @return $this
     */
    public function setCtrlName($ctrlName)
    {
        $this->ctrlName = $ctrlName;
        return $this;
    }

    public function getCtrlName()
    {
        return $this->ctrlName;
    }

    /**
     * @param $actName
     * @return $this
     */
    public function setActName($actName)
    {
        $this->actName = $actName;
        return $this;
    }


    public function getActName()
    {
        return $this->actName;
    }

    /**
     * 设置导出文件名
     * @param string $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
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