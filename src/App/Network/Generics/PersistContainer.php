<?php
namespace App\Network\Generics;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 02:15
 *
 * Class CreateContainer
 * @package App\Network\Generics
 */
class PersistContainer extends GenericContainer
{
    public function get()
    {
        $this->getGenericInjecter()->useGeneralize(YES);
        return parent::get();
    }
}