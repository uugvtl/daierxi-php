<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Brand\Entity;
use App\Globals\Legals\DisabledLegal;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 17:46
 *
 * Class AppService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Brand\Entity\Toggle
 */
class ToggleService extends AppService
{
    protected function madeRepositoryInstance()
    {
        $this->getGenericInjecter()->setGeneralize(NO);
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