<?php
namespace App\Entities\Bizbos\Make\Output\Poutput;
use App\Datasets\DataConst;
use App\Globals\Bizes\CalcBaseBO;
use App\Helpers\FormulaHelper;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/11/17
 * Time: 02:25
 *
 * Class MaterialBiz
 * @package App\Entities\Bizbos\Make\Output\Poutput
 * @property-read int       $material_id
 * @property-read int       $complex_id
 * @property-read string    $material_sn
 * @property-read float     $material_percent
 * @property-read int       $output_num         配方单品出货数量：件
 * @property-read float     $recipe_weight      配方单品重量：克
 * @property-read float     $material_weight    配方用到的合成料中原料重量
 */
class MaterialBO extends CalcBaseBO
{
    protected function column()
    {
        return [
            'material_id',
            'complex_id',
            'material_sn',
            'material_percent',
            'output_num',
            'recipe_weight',
            'material_weight'
        ];
    }

    public function belongId()
    {
        return $this->complex_id;
    }

    public function primaryKey()
    {
        return $this->material_id;
    }

    public function calc()
    {
        $formulaHelper = FormulaHelper::getInstance();
        $material_weight = $formulaHelper->calcRecipeWeight(bcmul($this->output_num, $this->recipe_weight, DataConst::DECIMAL),$this->material_percent);
        $this->setProperty('material_weight', $material_weight);
        return $this;
    }

}
