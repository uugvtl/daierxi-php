<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services;
use App\Globals\Legals\DisabledLegal;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 23:29
 *
 * Class DisabledService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services
 */
class DisabledService extends AppService
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
        return DisabledLegal::class;
    }
}