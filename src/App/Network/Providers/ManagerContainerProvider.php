<?php
namespace App\Network\Providers;
use App\Globals\Finals\Responder;
use App\Network\Modules\Manager\Generics\Creates\CreateContainer;
use App\Network\Modules\Manager\Generics\Creates\PackageCreateConst;

use App\Network\Modules\Manager\Generics\Exports\ExportContainer;
use App\Network\Modules\Manager\Generics\Exports\PackageExportConst;

use App\Network\Modules\Manager\Generics\Printing\PackagePrintConst;
use App\Network\Modules\Manager\Generics\Printing\PrintContainer;

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
class ManagerContainerProvider extends NetworkContainerProvider
{
    /**
     * 导出数据列表
     * @param array $condz
     * @return Responder
     */
    public function getExportResponder(array $condz= [])
    {
        $container = $this->madeContainer(PackageExportConst::PACKAGE, ExportContainer::class, $condz);
        return $container->get();
    }

    /**
     * 显示打印数据
     * @param array $condz            需要删除数据主键列表
     * @return Responder
     */
    public function getPrintResponder(array $condz= [])
    {
        $container = $this->madeContainer(PackagePrintConst::PACKAGE, PrintContainer::class, $condz);
        return $container->get();
    }


    /**
     * 获取数据列表
     * @param array $condz
     * @return Responder
     */
    public function getQueryResponder(array $condz= [])
    {
        $container = $this->madeContainer(PackageQueryConst::PACKAGE, QueryContainer::class, $condz);
        return $container->get();
    }


    /**
     * 保存数据--当只有一组ID列表时使用
     * @param array $aId
     * @return Responder
     */
    public function getPrimaryResponder(array $aId)
    {
        $container = $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $aId);
        return $container->get();
    }

    /**
     * 新增数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCreateResponder(array $posts)
    {
        $container = $this->madeContainer(PackageCreateConst::PACKAGE, CreateContainer::class, $posts);
        return $container->get();
    }

    /**
     * 更新数据--兼容多主键数据
     * @param array $posts                  需要保存的数据
     * @return Responder
     */
    public function getCommitResponder(array $posts)
    {
        $container = $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $posts);
        return $container->get();
    }

    /**
     * 删除数据
     * @param array $aId            需要删除数据主键列表
     * @return Responder
     */
    public function getRemoveResponder(array $aId=[])
    {
        $container = $this->madeContainer(PackageRemoveConst::PACKAGE, RemoveContainer::class, $aId);
        return $container->get();
    }
}