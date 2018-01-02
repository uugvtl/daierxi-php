<?php
namespace App\Console\Modules\Mission\Generics\Crontabs\Services;
use App\Console\Generics\Crontabs\GenericService;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 20:22
 *
 * Class CrontabService
 * @package App\Console\Modules\Mission\Generics\Crontabs\Services
 */
class CrontabService extends GenericService
{
    public function get()
    {
        $repository = $this->createRepositoryInstance();
        return $repository->get();
    }
}