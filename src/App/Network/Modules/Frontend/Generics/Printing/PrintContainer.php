<?php
namespace App\Network\Modules\Frontend\Generics\Printing;
use App\Network\Generics\Printing\GenericContainer;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 19:52
 *
 * Class PrintContainer
 * @package App\Network\Modules\Frontend\Generics\Printing
 */
class PrintContainer extends GenericContainer
{
    public function get()
    {
        $service = $this->madeService();
        return $service->get();

    }

}