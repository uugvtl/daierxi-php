<?php
namespace App\Network\Providers;
use App\Datasets\Consts\ClassConst;
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
    public function getExportContainer(array $condz= [])
    {
        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageExportConst::PACKAGE, ExportContainer::class, $condz):
            $this->madeContainer(PackageExportConst::PACKAGE, $this->getGenericContainerString(ClassConst::EXPORT_CATALOG), $condz);

        return $container;


    }

    public function getPrintContainer(array $condz= [])
    {

        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackagePrintConst::PACKAGE, PrintContainer::class, $condz):
            $this->madeContainer(PackagePrintConst::PACKAGE, $this->getGenericContainerString(ClassConst::PRINT_CATALOG), $condz);

        return $container;

    }

    public function getQueryContainer(array $condz= [])
    {
        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageQueryConst::PACKAGE, QueryContainer::class, $condz):
            $this->madeContainer(PackageQueryConst::PACKAGE, $this->getGenericContainerString(ClassConst::QUERY_CATALOG), $condz);

        return $container;

    }

    public function getPrimaryContainer(array $aId)
    {
        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $aId):
            $this->madeContainer(PackageModifyConst::PACKAGE, $this->getGenericContainerString(ClassConst::MODIFY_CATALOG), $aId);

        return $container;

    }

    public function getCreateContainer(array $posts)
    {
        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageCreateConst::PACKAGE, CreateContainer::class, $posts):
            $this->madeContainer(PackageCreateConst::PACKAGE, $this->getGenericContainerString(ClassConst::CREATE_CATALOG), $posts);

        return $container;

    }

    public function getCommitContainer(array $posts)
    {
        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $posts):
            $this->madeContainer(PackageModifyConst::PACKAGE, $this->getGenericContainerString(ClassConst::MODIFY_CATALOG), $posts);

        return $container;

    }

    public function getRemoveContainer(array $aId=[])
    {
        $container = $this->isModuleGenericContainer()?
            $this->madeContainer(PackageRemoveConst::PACKAGE, RemoveContainer::class, $aId):
            $this->madeContainer(PackageRemoveConst::PACKAGE, $this->getGenericContainerString(ClassConst::REMOVE_CATALOG), $aId);

        return $container;
    }
}