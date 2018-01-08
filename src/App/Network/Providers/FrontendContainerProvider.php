<?php
namespace App\Network\Providers;
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
class FrontendContainerProvider extends NetworkContainerProvider
{
    public function getExportContainer(array $condz= [])
    {
        return $this->madeContainer(PackageExportConst::PACKAGE, ExportContainer::class, $condz);
    }

    public function getPrintContainer(array $condz= [])
    {
        return $this->madeContainer(PackagePrintConst::PACKAGE, PrintContainer::class, $condz);
    }

    public function getQueryContainer(array $condz= [])
    {
        return $this->madeContainer(PackageQueryConst::PACKAGE, QueryContainer::class, $condz);
    }

    public function getPrimaryContainer(array $aId)
    {
        return $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $aId);
    }

    public function getCreateContainer(array $posts)
    {
        return $this->madeContainer(PackageCreateConst::PACKAGE, CreateContainer::class, $posts);
    }

    public function getCommitContainer(array $posts)
    {
        return $this->madeContainer(PackageModifyConst::PACKAGE, ModifyContainer::class, $posts);
    }

    public function getRemoveContainer(array $aId=[])
    {
        return $this->madeContainer(PackageRemoveConst::PACKAGE, RemoveContainer::class, $aId);
    }
}