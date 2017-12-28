<?php
namespace App\Network\Providers;
use App\Globals\Finals\Responder;
use App\Interfaces\Adapters\IShowAdapter;
use App\Network\Modules\Frontend\Generics\Creates\CreateContainer;
use App\Network\Modules\Frontend\Generics\Creates\PackageCreateConst;
use App\Network\Modules\Frontend\Generics\Exports\ExportContainer;
use App\Network\Modules\Frontend\Generics\Exports\PackageExportConst;
use App\Network\Modules\Frontend\Generics\Modifies\ModifyContainer;
use App\Network\Modules\Frontend\Generics\Modifies\PackageModifyConst;
use App\Network\Modules\Frontend\Generics\Printing\PackagePrintConst;
use App\Network\Modules\Frontend\Generics\Printing\PrintContainer;
use App\Network\Modules\Frontend\Generics\Queries\PackageQueryConst;
use App\Network\Modules\Frontend\Generics\Queries\QueryContainer;
use App\Network\Modules\Frontend\Generics\Removes\PackageRemoveConst;
use App\Network\Modules\Frontend\Generics\Removes\RemoveContainer;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/10/17
 * Time: 17:18
 *
 * Class FrontContainerProvider
 * @package App\Network\Providers
 */
class FrontendContainerProvider extends CtrlContainerProvider
{
    /**
     * 导出数据列表
     * @param array $condz
     * @return IShowAdapter
     */
    public function getExportAdapter(array $condz= [])
    {
        $this->parameter->init($condz);

        $genericInjecter = $this->createGenericInjecter();

        $genericInjecter->setDistributer($this->distributer);
        $genericInjecter->setParameter($this->parameter);
        $genericInjecter->setPackage(PackageExportConst::PACKAGE);

        $container = ExportContainer::getInstance();
        return $container->setGenericInjecter($genericInjecter)->run();
    }

    /**
     * 显示打印数据
     * @param array $condz            需要删除数据主键列表
     * @return IShowAdapter
     */
    public function getPrintAdapter(array $condz= [])
    {
        $this->parameter->init($condz);

        $genericInjecter = $this->createGenericInjecter();

        $genericInjecter->setDistributer($this->distributer);
        $genericInjecter->setParameter($this->parameter);
        $genericInjecter->setPackage(PackagePrintConst::PACKAGE);

        $container = PrintContainer::getInstance();
        return $container->setGenericInjecter($genericInjecter)->run();
    }


    /**
     * 获取数据列表
     * @param array $condz
     * @return Responder
     */
    public function getQueryResponder(array $condz= [])
    {
        $this->parameter->init($condz);

        $genericInjecter = $this->createGenericInjecter();

        $genericInjecter->setDistributer($this->distributer);
        $genericInjecter->setParameter($this->parameter);
        $genericInjecter->setPackage(PackageQueryConst::PACKAGE);

        $container = QueryContainer::getInstance();
        return $container->setGenericInjecter($genericInjecter)->run();
    }


    /**
     * 保存数据--当只有一组ID列表时使用
     * @param array $aId
     * @return Responder
     */
    public function getPrimaryResponder(array $aId)
    {
        $this->parameter->init($aId);

        $genericInjecter = $this->createGenericInjecter();

        $genericInjecter->setDistributer($this->distributer);
        $genericInjecter->setParameter($this->parameter);
        $genericInjecter->setPackage(PackageModifyConst::PACKAGE);

        $container = ModifyContainer::getInstance();
        return $container->setGenericInjecter($genericInjecter)->run();

    }

    /**
     * 新增数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCreateResponder(array $posts)
    {
        $this->parameter->init($posts);

        $genericInjecter = $this->createGenericInjecter();

        $genericInjecter->setDistributer($this->distributer);
        $genericInjecter->setParameter($this->parameter);
        $genericInjecter->setPackage(PackageCreateConst::PACKAGE);

        $container = CreateContainer::getInstance();
        return $container->setGenericInjecter($genericInjecter)->run();
    }

    /**
     * 更新数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCommitResponder(array $posts)
    {
        $this->parameter->init($posts);

        $genericInjecter = $this->createGenericInjecter();

        $genericInjecter->setDistributer($this->distributer);
        $genericInjecter->setParameter($this->parameter);
        $genericInjecter->setPackage(PackageModifyConst::PACKAGE);

        $container = ModifyContainer::getInstance();
        return $container->setGenericInjecter($genericInjecter)->run();
    }

    /**
     * 删除数据
     * @param array $aId            需要删除数据主键列表
     * @return Responder
     */
    public function getDeleteResponder(array $aId=[])
    {
        $this->parameter->init($aId);

        $genericInjecter = $this->createGenericInjecter();

        $genericInjecter->setDistributer($this->distributer);
        $genericInjecter->setParameter($this->parameter);
        $genericInjecter->setPackage(PackageRemoveConst::PACKAGE);

        $container = RemoveContainer::getInstance();
        return $container->setGenericInjecter($genericInjecter)->run();
    }
}