<?php
namespace App\Globals\Generics;
use App\Globals\Bizes\BaseDo;
use App\Helpers\InstanceHelper;
use App\Helpers\JsonHelper;
use App\Libraries\Daoes\AppDao;
use App\Unusually\BizLogicExceptions;
use const BACKSLASH;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 1/1/18
 * Time: 21:32
 *
 * Class FormLogic
 * @package App\Globals\Generics
 */
abstract class FormLogic extends BaseLogic
{
    /**
     * 开始手动事物处理
     * @return bool
     */
    final protected function transaction()
    {
        $toggle = false;
        $dao = AppDao::getInstance();
        try {

            $dao->start();
            $toggle = $this->commit();
            $dao->end();
        }
        catch(BizLogicExceptions $e) {
            $dao->rollback();
            $jsonHelper = JsonHelper::getInstance();
            $jsonHelper->sendExcp($e);
        }

        return $toggle;

    }

    /**
     * 持久化数据
     * @return bool
     */
    protected function commit()
    {
        return true;
    }

    /**
     * 获取相关的实体类--可以进行override使用默认类
     * @param array $params             实体需要的初始化参数
     * @return BaseDo
     */
    protected function createBizDo(array $params)
    {
        $instanceHelper = InstanceHelper::getInstance();
        $bizDo = $instanceHelper->build(BaseDo::class, $this->getBizDoClassString());
        return $bizDo->init($params);
    }

    /**
     * 获取相关的实体类--可以进行override使用默认类
     * @param array $params             实体需要的初始化参数
     * @return BaseDo
     */
    protected function createBizBo(array $params)
    {
        $instanceHelper = InstanceHelper::getInstance();
        $bizDo = $instanceHelper->build(BaseDo::class, $this->getBizBoClassString());
        return $bizDo->init($params);
    }


    /**
     * 获取BizDo类的全名
     * @return string
     */
    private function getBizDoClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getPath();
        $classname = $package.BACKSLASH.'Entities'.BACKSLASH.'Bizdos'.BACKSLASH.$path.'Do';
        return $classname;
    }

    /**
     * 获取BizBo类的全名
     * @return string
     */
    private function getBizBoClassString()
    {
        $genericInjecter = $this->getGenericInjecter();
        $package = $genericInjecter->getPackage();
        $path = $genericInjecter->getDistributer()->getPath();
        $classname = $package.BACKSLASH.'Entities'.BACKSLASH.'Bizbos'.BACKSLASH.$path.'Bo';
        return $classname;
    }





}