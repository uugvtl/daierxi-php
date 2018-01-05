<?php
namespace App\Network\Modules\Manager\Generics\Printing\Factories\Logics\Make\Output\Poutput;
use App\Network\Modules\Manager\Generics\Printing\Factories\Logics\PrintLogic;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 18:15
 *
 * Class DefaultLogic
 * @package App\Network\Modules\Manager\Generics\Printing\Factories\Logics\Make\Output\Poutput
 */
class DefaultLogic extends PrintLogic
{

    protected function commit()
    {
        $store = $this->getStore();
        $sqlangInjecter = $this->getRepositpry()->get();

        $store->setSqlangInjecter($sqlangInjecter)->getRow();

        $this->getRepositpry()->getGenericInjecter()->getDistributer()->setPrefixString('Complex');
        $sqlangInjecter = $this->getRepositpry()->get();
        $store->setSqlangInjecter($sqlangInjecter)->getList();
    }
}