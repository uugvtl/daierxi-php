<?php
namespace App\Network\Providers;
use App\Datasets\Consts\ClassConst;
use App\Network\Modules\Manager\Generics\Creates\PackageCreateConst;
use App\Network\Modules\Manager\Generics\Exports\PackageExportConst;
use App\Network\Modules\Manager\Generics\Printing\PackagePrintConst;
use App\Network\Modules\Manager\Generics\Queries\PackageQueryConst;
use App\Network\Modules\Manager\Generics\Modifies\PackageModifyConst;
use App\Network\Modules\Manager\Generics\Removes\PackageRemoveConst;
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
        $containerString = $this->getGenericContainerString(ClassConst::GENERIC_PREFIX);
        return $this->madeContainer(PackageExportConst::PACKAGE, $containerString, $condz);
    }

    public function getPrintContainer(array $condz= [])
    {
        $containerString = $this->getGenericContainerString(ClassConst::GENERIC_PREFIX);
        return $this->madeContainer(PackagePrintConst::PACKAGE, $containerString, $condz);

    }

    public function getQueryContainer(array $condz= [])
    {
        $containerString = $this->getGenericContainerString(ClassConst::GENERIC_PREFIX);
        return $this->madeContainer(PackageQueryConst::PACKAGE, $containerString, $condz);

    }

    public function getPrimaryContainer(array $aId)
    {
        $containerString = $this->getGenericContainerString(ClassConst::GENERIC_PREFIX);
        return $this->madeContainer(PackageModifyConst::PACKAGE, $containerString, $aId);
    }

    public function getCreateContainer(array $posts)
    {
        $containerString = $this->getGenericContainerString(ClassConst::CREATE_PREFIX);
        return $this->madeContainer(PackageCreateConst::PACKAGE, $containerString, $posts);

    }

    public function getCommitContainer(array $posts)
    {
        $containerString = $this->getGenericContainerString(ClassConst::CREATE_PREFIX);
        return $this->madeContainer(PackageModifyConst::PACKAGE, $containerString, $posts);

    }

    public function getRemoveContainer(array $aId=[])
    {
        $containerString = $this->getGenericContainerString(ClassConst::GENERIC_PREFIX);
        return $this->madeContainer(PackageRemoveConst::PACKAGE, $containerString, $aId);
    }
}