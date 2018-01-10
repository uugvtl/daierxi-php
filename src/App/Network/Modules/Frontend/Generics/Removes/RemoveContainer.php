<?php
namespace App\Network\Modules\Frontend\Generics\Removes;
use App\Network\Generics\Removes\GenericContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 27/12/17
 * Time: 19:45
 *
 * Class RemoveContainer
 * @package App\Network\Modules\Frontend\Generics\Removes
 */
class RemoveContainer extends GenericContainer
{
    public function get()
    {
        $service = $this->madeService();
        return $service->get();
    }

}