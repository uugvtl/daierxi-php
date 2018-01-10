<?php
namespace App\Network\Modules\Frontend\Generics\Queries;
use App\Network\Generics\Queries\GenericContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 12:43
 *
 * Class QueryContainer
 * @package App\Network\Modules\Frontend\Generics\Queries
 */
class QueryContainer extends GenericContainer
{
    public function get()
    {
        $service = $this->madeService();
        return $service->get();

    }
}