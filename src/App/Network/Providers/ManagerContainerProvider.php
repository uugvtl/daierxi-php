<?php
namespace App\Network\Providers;
use App\Datasets\Consts\ClassConst;
use App\Frames\Generics\FrameContainer;
use App\Helpers\InstanceHelper;
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
        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::EXPORT_CATALOG));
            $container->init($condz);
        }
        else
        {
            $container = $this->madeContainer(PackageExportConst::PACKAGE, ExportContainer::class, $condz);
        }

        return $container;


    }

    public function getPrintContainer(array $condz= [])
    {

        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::PRINT_CATALOG));
            $container->init($condz);
        }
        else
        {
            $container = $this->madeContainer(PackagePrintConst::PACKAGE, PrintContainer::class, $condz);
        }

        return $container;

    }

    public function getQueryContainer(array $condz= [])
    {

        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::QUERY_CATALOG));
            $container->init($condz);
        }
        else
        {
            $container = $this->madeContainer(PackageQueryConst::PACKAGE, QueryContainer::class, $condz);
        }

        return $container;

    }

    public function getPrimaryContainer(array $aId)
    {
        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::MODIFY_CATALOG));
            $container->init($aId);
        }
        else
        {
            $container = $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $aId);
        }

        return $container;

    }

    public function getCreateContainer(array $posts)
    {
        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::CREATE_CATALOG));
            $container->init($posts);
        }
        else
        {
            $container = $this->madeContainer(PackageCreateConst::PACKAGE, CreateContainer::class, $posts);
        }

        return $container;

    }

    public function getCommitContainer(array $posts)
    {
        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::MODIFY_CATALOG));
            $container->init($posts);
        }
        else
        {
            $container = $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $posts);
        }

        return $container;

    }

    public function getRemoveContainer(array $aId=[])
    {
        if(!$this->isModuleGenericContainer())
        {
            $instanceHelper = InstanceHelper::getInstance();
            $container = $instanceHelper->build(FrameContainer::class, $this->getGenericContainerString(ClassConst::REMOVE_CATALOG));
            $container->init($aId);
        }
        else
        {
            $container = $this->madeContainer(PackageRemoveConst::PACKAGE, RemoveContainer::class, $aId);
        }

        return $container;
    }
}