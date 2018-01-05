<?php
namespace App\Entities\Bizdos\Make;
use App\Globals\Bizes\BaseDo;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;
use App\Tables\Stock\IRecipeSkuTable;
use App\Tables\Stock\IRecipeStatusTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 5/1/18
 * Time: 21:51
 *
 * Class OutputBaseDo
 * @package App\Entities\Bizdos\Make
 * @property-read int       $sdetail_id
 * @property-read int       $output_status
 * @property-read string    $output_sn
 * @property-read int       $sku_id
 * @property-read string    $sku_sn
 * @property-read string    $sku_name
 * @property-read string    $goods_name
 * @property-read int       $output_num
 * @property-read float     $recipe_weight
 * @property-read string    $recipe_craft
 * @property-read string    $water_item
 * @property-read float     $deionized_water
 * @property-read string    $operator_name
 * @property-read int       $is_print
 */
class OutputBaseDo extends BaseDo
{
//    /**
//     * @var IChangeStatusable
//     */
//    protected $statusBiz;

    protected function column()
    {
        return [
            'output_sn',
            'sdetail_id',
            'sku_id',
            'sku_sn',
            'sku_name',
            'goods_name',
            'output_num',
            'recipe_weight',
            'recipe_craft',
            'water_item',
            'deionized_water',
            'operator_name',
            'output_status',
            'is_print'
        ];

    }

    public function primaryKey()
    {
        return $this->sdetail_id;
    }

//    /**
//     * @param int $output_status
//     * @return IChangeStatusable
//     */
//    public function createStatusBiz($output_status)
//    {
//        $className = StatusBaseBiz::PACKAGE.'\Status'.$output_status.'Biz';
//        $entity = call_user_func(array($className, 'createInstance'));
//        return $entity->construct($this);
//    }

    /**
     * 保存状态到数据到中，不带事务
     * @param bool $toggle
     * @return $this
     */
    protected function saveStatus($toggle)
    {
        if($toggle)
        {
            $sqlHelper = SqlHelper::getInstance();

            $fields = [
                'sdetail_id'    =>$this->sdetail_id,
                'output_status' =>$this->output_status
            ];
            $table = IRecipeStatusTable::Name;
            $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
            $this->getCache()->getDao()->submit($sql);
            $this->getCache()->updateCacheDependencies($table);
        }

        return $this;
    }

    public function submit()
    {
        $table = IRecipeSkuTable::Name;

        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->sdetail_id);
        $where = 'AND sdetail_id='.$id;

        $fields = $this->getValidFields();
        $sql =  $sqlHelper->getUpdateString($fields, $table, $where);

        $toggle = $this->getCache()->getDao()->submit($sql);

        if($toggle)
        {
            $this->saveStatus($toggle);
            $this->getCache()->updateCacheDependencies($table);
        }

        $this->setPersistent(YES);
        return $this;
    }

    public function insert()
    {
        return $this;
    }

    public function delete()
    {
        return $this;
    }
}