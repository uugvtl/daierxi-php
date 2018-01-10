<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services;
use App\Globals\Legals\EnabledLegal;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 23:30
 *
 * Class EnabledService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services
 */
class EnabledService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->useGeneralize(NO);
        return parent::madeRepositoryInstance();
    }

    /**
     * @return string
     */
    protected function getLegalClassString()
    {
        return EnabledLegal::class;
    }
}