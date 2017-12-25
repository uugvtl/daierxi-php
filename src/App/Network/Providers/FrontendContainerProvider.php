<?php
namespace App\Network\Providers;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/10/17
 * Time: 17:18
 *
 * Class FrontContainerProvider
 * @package App\Network\Providers
 */
abstract class FrontendContainerProvider extends CtrlContainerProvider
{
//    /**
//     * 导出数据列表
//     * @param array $condz
//     * @return IExportAdapter
//     */
//    public function doExportResult(array $condz= [])
//    {
//        $this->parameter->init($condz);
//        $factory = ExportFactory::getFactory(ExportPackageConst::PACKAGE, $this->getSpread());
//        $container = $factory->setBaseClass(ExportPackageConst::CONTAINER)->createInstance($this->distributer);/* @var $container IExportContainer */
//        return $container->setParameter($this->parameter)->launch();
//    }
//
//    /**
//     * 显示打印数据
//     * @param array $condz            需要删除数据主键列表
//     * @return IPrintAdapter
//     */
//    public function doPrintResult(array $condz= [])
//    {
//        $this->parameter->init($condz);
//        $factory = PrintFactory::getFactory(PrintPackageConst::PACKAGE, $this->getSpread());
//        $container = $factory->setBaseClass(PrintPackageConst::CONTAINER)->createInstance($this->distributer);/* @var $container IPrintContainer */
//        return $container->setParameter($this->parameter)->launch();
//    }
//
//    /**
//     * 获取数据列表
//     * @param array $condz
//     * @return Result
//     */
//    public function getQueryResult(array $condz= [])
//    {
//        $this->parameter->init($condz);
//        $factory = QueryFactory::getFactory(QueryPackageConst::PACKAGE, $this->getSpread());
//        $container = $factory->setBaseClass(QueryPackageConst::CONTAINER)->createInstance($this->distributer);/* @var $container IQueryContainer */
//        return $container->setParameter($this->parameter)->launch();
//    }
//
//
//    /**
//     * 保存数据--当只有一组ID列表时使用
//     * @param array $aId
//     * @return Result
//     */
//    public function getPrimaryResult(array $aId)
//    {
//        $this->parameter->init($aId);
//        $factory = FormFactory::getFactory(FormPackageConst::PACKAGE, $this->getSpread());
//        $container = $factory->setBaseClass(FormPackageConst::CONTAINER)->createInstance($this->distributer);/* @var $container IFormContainer */
//        return $container->setParameter($this->parameter)->launch();
//    }
//
//    /**
//     * 新增数据--兼容多主键数据
//     * @param array $posts                  需要保存的数据
//     * @return Result
//     */
//    public function getCreateResult(array $posts)
//    {
//        $this->parameter->init($posts);
//        $factory = FormFactory::getFactory(FormPackageConst::PACKAGE, $this->getSpread());
//        $container = $factory->setBaseClass(FormPackageConst::CONTAINER)->createInstance($this->distributer);/* @var $container IFormContainer */
//        return $container->setParameter($this->parameter)->launch();
//    }
//
//    /**
//     * 更新数据--兼容多主键数据
//     * @param array $posts                  需要保存的数据
//     * @return Result
//     */
//    public function getCommitResult(array $posts)
//    {
//        $this->parameter->init($posts);
//        $factory = FormFactory::getFactory(FormPackageConst::PACKAGE, $this->getSpread());
//        $container = $factory->setBaseClass(FormPackageConst::CONTAINER)->createInstance($this->distributer);/* @var $container IFormContainer */
//        return $container->setParameter($this->parameter)->launch();
//    }
//
//    /**
//     * 删除数据
//     * @param array $aId            需要删除数据主键列表
//     * @return Result
//     */
//    public function getRemoveResult(array $aId=[])
//    {
//        $this->parameter->init($aId);
//        $factory = RemoveFactory::getFactory(RemovePackageConst::PACKAGE, $this->getSpread());
//        $container = $factory->setBaseClass(RemovePackageConst::CONTAINER)->createInstance($this->distributer);/* @var $container IRemoveContainer */
//        return $container->setParameter($this->parameter)->launch();
//    }
}