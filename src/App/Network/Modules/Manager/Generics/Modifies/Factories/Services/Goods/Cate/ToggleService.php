<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate;
use App\Globals\Legals\DisabledLegal;
use App\Network\Modules\Manager\Generics\Modifies\Factories\Services\AppService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 22:33
 *
 * Class ToggleService
 * @package App\Network\Modules\Manager\Generics\Modifies\Factories\Services\Goods\Cate
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