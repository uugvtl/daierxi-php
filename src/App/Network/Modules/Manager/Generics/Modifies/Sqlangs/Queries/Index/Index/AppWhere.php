<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Sqlangs\Queries\Index\Index;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 11/1/18
 * Time: 17:52
 *
 * Class AppWhere
 * @package App\Network\Modules\Manager\Generics\Modifies\Sqlangs\Queries\Index\Index
 */
class AppWhere extends BaseWhere
{
    protected function getStmt()
    {
        $this->setNothing(YES);

        $where = '';

        $condz = $this->getCondition();

        $sqlHelper = SqlHelper::getInstance();

        if($sqlHelper->is_string($condz, 'account') && $sqlHelper->is_string($condz, 'password'))
        {
            $namehash = md5($condz['account']);
            $quoteNamehash = $this->getQuoteValue($namehash);
            $where .= " AND m.namehash={$quoteNamehash}";

            $passwordhash = md5(sha1($condz['password']));
            $quotePasswordhash = $this->getQuoteValue($passwordhash);

            $where .= " AND m.password={$quotePasswordhash}";
        }

        return $where;
    }
}