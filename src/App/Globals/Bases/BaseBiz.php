<?php
namespace App\Globals\Bases;
use App\Datasets\ExcpCode;
use App\Datasets\ExcpMsg;
use App\Unusually\BizLogicExceptions;
use App\Helpers\JsonHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 19:24
 *
 * Class BaseDo
 * @package App\Globals\Bases
 */
abstract class BaseBiz extends BaseClass
{

    /**
     * @var array
     */
    private $properties;

    abstract protected function column();


    public function init(...$args)
    {
        $this->properties = $this->verify($args[0]);
        return $this;
    }


    final public function __get($propName)
    {
        return $this->getProperty($propName);
    }


    /**
     * @param string $propName
     * @param mixed $propValue
     * @return $this
     */
    final public function __set($propName, $propValue)
    {
        return $this->setProperty($propName, $propValue);
    }


    final public function __isset($propName)
    {
        return array_key_exists($propName, $this->properties)?true:false;
    }

    /**
     * 合并实体类的属性--此方法只能在persetner类中调用
     * @param string $propName          属性名称
     * @param mixed $propValue          属性值
     * @return $this
     */
    final public function setProperty($propName, $propValue)
    {
        try
        {
            if($this->hasProperty($propName))
                $this->properties[$propName] = $propValue;
            else
            {
                $msg = sprintf(ExcpMsg::PROPERTY_NOT_IN_CLASS, __CLASS__, $propName);
                throw new BizLogicExceptions($msg,ExcpCode::PROPERTY_NOT_IN_CLASS);
            }
        }catch (BizLogicExceptions $e)
        {
            $jsonHelper = JsonHelper::getInstance();
            $jsonHelper->sendExcp($e);
        }

        return $this;
    }

    /**
     * 判断实体类中是否有指定我属性
     * @param string $propName      属性名称
     * @return bool                 有则返回true,否则返回false
     */
    final public function hasProperty($propName)
    {
        $toggle = false;
        $column = $this->column();

        if(is_array($column))
            in_array($propName, $column) && $toggle=true;

        return $toggle;
    }

    /**
     * 获取实体类中是否有指定属性
     * @param string $propName      属性名称
     * @return mixed
     */
    final public function getProperty($propName)
    {
        return array_key_exists($propName, $this->properties)?$this->properties[$propName]:null;
    }

    /**
     * 获取属性列表
     * @return array
     */
    final public function getProperties()
    {
        return $this->properties;
    }

    /**
     * 获取非空字串的数据，主要是用来做SQL数据
     * @return array
     */
    final protected function getValidFields()
    {
        return array_filter($this->getProperties(), function($value){
            $toggle = false;
            if(is_scalar($value))
            {
                $val = (string)$value;
                $toggle = $val!=='';
            }

            return $toggle;
        });
    }



    protected function afterInstance()
    {
        $this->properties = [];
    }

    /**
     * 初始化数据验证，是否是类属性
     * @param array $data
     * @return array
     */
    private function verify($data)
    {
        $properties = [];
        $column = $this->column();
        if(is_array($column))
        {
            foreach ($column as $key)
            {
                if(isset($data[$key]))
                    $properties[$key] =  $data[$key];
            }
        }

        return $properties;
    }
}