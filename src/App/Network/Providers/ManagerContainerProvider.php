<?php
namespace App\Network\Providers;
use App\Globals\Finals\Responder;
use App\Interfaces\Adapters\IShowAdapter;
use App\Network\Modules\Manager\Generics\Creates\CreateContainer;
use App\Network\Modules\Manager\Generics\Creates\PackageCreateConst;

use App\Network\Modules\Manager\Generics\Exports\ExportContainer;
use App\Network\Modules\Manager\Generics\Exports\PackageExportConst;

use App\Network\Modules\Manager\Generics\Prints\PackagePrintConst;

use App\Network\Modules\Manager\Generics\Prints\PrintContainer;
use App\Network\Modules\Manager\Generics\Queries\PackageQueryConst;
use App\Network\Modules\Manager\Generics\Queries\QueryContainer;

use App\Network\Modules\Manager\Generics\Modifies\ModifyContainer;
use App\Network\Modules\Manager\Generics\Modifies\PackageModifyConst;

use App\Network\Modules\Manager\Generics\Removes\PackageRemoveConst;
use App\Network\Modules\Manager\Generics\Removes\RemoveContainer;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/10/17
 * Time: 19:02
 *
 * Class ManagerContainerProvider
 * @package App\Network\Providers
 */
class ManagerContainerProvider extends CtrlContainerProvider
{
    /**
     * 导出数据列表
     * @param array $condz
     * @return IShowAdapter
     */
    public function getExportAdapter(array $condz= [])
    {
        $this->parameter->init($condz);

        $this->genericInjecter->setDistributer($this->distributer);
        $this->genericInjecter->setParameter($this->parameter);
        $this->genericInjecter->setPackage(PackageExportConst::PACKAGE);

        $container = ExportContainer::getInstance();
        return $container->setGenericInjecter($this->genericInjecter)->run();
    }

    /**
     * 显示打印数据
     * @param array $condz            需要删除数据主键列表
     * @return IShowAdapter
     */
    public function getPrintAdapter(array $condz= [])
    {
        $this->parameter->init($condz);

        $this->genericInjecter->setDistributer($this->distributer);
        $this->genericInjecter->setParameter($this->parameter);
        $this->genericInjecter->setPackage(PackagePrintConst::PACKAGE);

        $container = PrintContainer::getInstance();
        return $container->setGenericInjecter($this->genericInjecter)->run();
    }


    /**
     * 获取数据列表
     * @param array $condz
     * @return Responder
     */
    public function getQueryResponder(array $condz= [])
    {
        $this->parameter->init($condz);

        $this->genericInjecter->setDistributer($this->distributer);
        $this->genericInjecter->setParameter($this->parameter);
        $this->genericInjecter->setPackage(PackageQueryConst::PACKAGE);

        $container = QueryContainer::getInstance();
        return $container->setGenericInjecter($this->genericInjecter)->run();
    }


    /**
     * 保存数据--当只有一组ID列表时使用
     * @param array $aId
     * @return Responder
     */
    public function getPrimaryResponder(array $aId)
    {
        $this->parameter->init($aId);

        $this->genericInjecter->setDistributer($this->distributer);
        $this->genericInjecter->setParameter($this->parameter);
        $this->genericInjecter->setPackage(PackageModifyConst::PACKAGE);

        $container = ModifyContainer::getInstance();
        return $container->setGenericInjecter($this->genericInjecter)->run();

    }

    /**
     * 新增数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCreateResponder(array $posts)
    {
        $this->parameter->init($posts);

        $this->genericInjecter->setDistributer($this->distributer);
        $this->genericInjecter->setParameter($this->parameter);
        $this->genericInjecter->setPackage(PackageCreateConst::PACKAGE);

        $container = CreateContainer::getInstance();
        return $container->setGenericInjecter($this->genericInjecter)->run();
    }

    /**
     * 更新数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCommitResponder(array $posts)
    {
        $this->parameter->init($posts);

        $this->genericInjecter->setDistributer($this->distributer);
        $this->genericInjecter->setParameter($this->parameter);
        $this->genericInjecter->setPackage(PackageModifyConst::PACKAGE);

        $container = ModifyContainer::getInstance();
        return $container->setGenericInjecter($this->genericInjecter)->run();
    }

    /**
     * 删除数据
     * @param array $aId            需要删除数据主键列表
     * @return Responder
     */
    public function getDeleteResponder(array $aId=[])
    {
        $this->parameter->init($aId);

        $this->genericInjecter->setDistributer($this->distributer);
        $this->genericInjecter->setParameter($this->parameter);
        $this->genericInjecter->setPackage(PackageRemoveConst::PACKAGE);

        $container = RemoveContainer::getInstance();
        return $container->setGenericInjecter($this->genericInjecter)->run();
    }
}