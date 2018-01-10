<?php
namespace App\Network\Modules\Manager\Generics\Printing\Entities\Bizdos\Make\Output\Poutput;
use App\Datasets\Consts\TableConst;
use App\Entities\Bizdos\Make\OutputBaseDo;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 6/1/18
 * Time: 17:30
 *
 * Class DefaultDo
 * @package App\Network\Modules\Manager\Generics\Printing\Entities\Bizdos\Make\Output\Poutput
 */
class AppDo extends OutputBaseDo
{
    public function submit()
    {
        if(!$this->isPrinted())
        {
            $stringHelper   = StringHelper::getInstance();
            $sqlHelper      = SqlHelper::getInstance();

            $this->setPrinted()->changePrepareStatus();

            $fields = [
                'output_status' =>$this->output_status,
                'is_print'      =>$this->is_print
            ];

            $table = TableConst::STOCK_RECIPE_SKU;

            $id = $stringHelper->quoteValue($this->sdetail_id);
            $where = 'AND sdetail_id='.$id;


            $sql =  $sqlHelper->getUpdateString($fields, $table, $where);

            $toggle = $this->getCache()->getDao()->submit($sql);
            $toggle && $this->getCache()->updateCacheDependencies($table);
        }
        $this->setPersistent(YES);
        return $this;

    }

    public function changePrepareStatus()
    {
        parent::changePrepareStatus();

        $sqlHelper      = SqlHelper::getInstance();

        $fileds = [
            'sdetail_id'    =>$this->primaryKey(),
            'output_status' =>$this->output_status
        ];

        $table = TableConst::STOCK_RECIPE_STATUS;

        $sql = $sqlHelper->getCreateString($fileds, $table, SqlHelper::SQL_CREATE_IGNORE);
        $toggle = $this->getCache()->getDao()->submit($sql);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }
}