<?php
namespace App\Network\Modules\Manager\Generics\Modifies;
use App\Network\Generics\Modifies\GenericContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 19:37
 *
 * Class ModifyContainer
 * @package App\Network\Modules\Manager\Generics\Modifies
 */
class ModifyContainer extends GenericContainer
{
    public function get()
    {
        $service = $this->madeService();
        return $service->get();
    }
}