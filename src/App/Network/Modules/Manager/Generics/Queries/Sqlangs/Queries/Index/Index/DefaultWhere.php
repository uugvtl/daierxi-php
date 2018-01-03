<?php
namespace App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Index\Index;
use App\Globals\Sqlangs\BaseWhere;
use App\Helpers\SqlHelper;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 23:46
 *
 * Class PrimaryWhere
 * @package App\Network\Modules\Manager\Generics\Queries\Sqlangs\Queries\Index\Index
 */
class DefaultWhere extends BaseWhere
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