<?php
namespace App\Network\Providers;
use App\Network\Modules\Frontend\Generics\Creates\PackageCreateConst;
use App\Network\Modules\Frontend\Generics\Exports\PackageExportConst;
use App\Network\Modules\Frontend\Generics\Modifies\PackageModifyConst;
use App\Network\Modules\Frontend\Generics\Printing\PackagePrintConst;
use App\Network\Modules\Frontend\Generics\Queries\PackageQueryConst;
use App\Network\Modules\Frontend\Generics\Removes\PackageRemoveConst;
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
        $containerString = $this->getGenericContainerString();
        return $this->madeContainer(PackageExportConst::PACKAGE, $containerString, $condz);
    }

    public function getPrintContainer(array $condz= [])
    {
        $containerString = $this->getGenericContainerString();
        return $this->madeContainer(PackagePrintConst::PACKAGE, $containerString, $condz);

    }

    public function getQueryContainer(array $condz= [])
    {
        $containerString = $this->getGenericContainerString();
        return $this->madeContainer(PackageQueryConst::PACKAGE, $containerString, $condz);

    }

    public function getPrimaryContainer(array $aId)
    {
        return $this->getCommitContainer($aId);
    }

    public function getCreateContainer(array $posts)
    {
        $containerString = $this->getGenericContainerString();
        return $this->madeContainer(PackageCreateConst::PACKAGE, $containerString, $posts);

    }

    public function getCommitContainer(array $posts)
    {
        $containerString = $this->getGenericContainerString();
        return $this->madeContainer(PackageModifyConst::PACKAGE, $containerString, $posts);

    }

    public function getRemoveContainer(array $aId=[])
    {
        $containerString = $this->getGenericContainerString();
        return $this->madeContainer(PackageRemoveConst::PACKAGE, $containerString, $aId);
    }
}