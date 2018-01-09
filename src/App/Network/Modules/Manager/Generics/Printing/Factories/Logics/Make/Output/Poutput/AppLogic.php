<?php
namespace App\Network\Modules\Manager\Generics\Printing\Factories\Logics\Make\Output\Poutput;
use App\Entities\Bizbos\Make\Output\Poutput\MaterialBO;
use App\Entities\Bizdos\Make\OutputBaseDo;
use App\Globals\Finals\Responder;
use App\Helpers\ArrayHelper;
use App\Helpers\FormulaHelper;
use App\Helpers\InstanceHelper;
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
class AppLogic extends PrintLogic
{
    /**
     * @var OutputBaseDo
     */
    private $bizDo;

    protected function beforeBegin()
    {
        $store = $this->getStore();
        $sqlangInjecter = $this->getRepositpry()->get();

        $rows = $store->setSqlangInjecter($sqlangInjecter)->getRow();
        $classString = $this->getBizDoClassString();

        $instanceHelper = InstanceHelper::getInstance();
        $this->bizDo = $instanceHelper->build(OutputBaseDo::class, $classString);
        $this->bizDo->init($rows)->initStatusBo();
        $this->bizDo->setCache($store->getCache());
    }

    protected function commit()
    {
        $toggle = $this->bizDo->submit()->isPersistent();
        return $toggle;
    }

    protected function run(Responder $responder)
    {

        $formulaHelper = FormulaHelper::getInstance();
        $arrayHelper = ArrayHelper::getInstance();

        $info = $this->bizDo->getProperties();
        $info['account_name'] = $this->getGenericInjecter()->getParameter()->getValue('account_name');

        $complexRecords = $this->listComplexRecords();
        $aComplexIds = $arrayHelper->column($complexRecords, 'complex_id');
        $materialRecords = $this->listMaterialRecords($aComplexIds);




        $aComplexs  = $complexRecords;
        $aMaterials = $materialRecords;
        $info['sku_weight'] = bcmul($info['output_num'], $info['recipe_weight'], 4);

        $aComplexInfo = $arrayHelper->reduce(function ($result, $rows) {
            $result[$rows['complex_id']] = [
                'complex_craft'     =>$rows['complex_craft'],
                'complex_sn'        =>$rows['complex_sn'],
                'complex_weight'    =>$rows['output_num'],
                'complex_percent'   =>$rows['percent']
            ];
            return $result;
        }, $aComplexs);

        /* 把去离子水加入到合成料列表当中 BEGIN */
        $aComplexs[] = [
            'complex_item'  =>$info['water_item'],
            'complex_sn'    =>'去离子水',
            'percent'       =>$info['deionized_water'],
            'output_num'    =>$formulaHelper->calcRecipeWeight($info['sku_weight'], $info['deionized_water'])
        ];
        $letter = $arrayHelper->column($aComplexs,'complex_item');
        array_multisort($letter,SORT_ASC,$aComplexs);
        /* 把去离子水加入到合成料列表当中 END */

        $pdf = $this->getAdapter();

        $pdf->setFont("cid0cs",'',14);
        $pdf->addPage('L');

        if(empty($list))
        {
            $nodata = $this->view->getPartial('make/output/nodata');
            $pdf->writeHTML($nodata);
            $pdf->lastPage();
            goto finish;
        }

        $mainPage = $this->view->getPartial('make/output/complex', [
            'info'=>$info,
            'complexs'=>$aComplexs
        ]);

        $pdf->writeHTML($mainPage);
        $pdf->lastPage();


        foreach ($aMaterials as $complex_id=>$materials)
        {
            $pdf->addPage('L');

            $subPage = $this->view->getPartial('make/output/material',[
                'materials' => $materials,
                'complex'   => $aComplexInfo[$complex_id]
            ]);

            $pdf->writeHTML($subPage);
            $pdf->lastPage();
        }


        finish:
        $responder->toggle = YES;
        $responder->adapter = $pdf;
    }

    /**
     * @return array
     */
    private function listComplexRecords()
    {
        $store = $this->getStore();

        $genericInjecter = $this->getRepositpry()->getGenericInjecter();
        $genericInjecter->getDistributer()->setPrefixString('Complex');

        $sqlangInjecter = $this->getRepositpry()->get();
        return $store->setSqlangInjecter($sqlangInjecter)->getList();
    }

    /**
     * @param array $args
     * @return array
     */
    private function listMaterialRecords(array $args)
    {
        $list = $records = [];
        $store = $this->getStore();

        $genericInjecter = $this->getRepositpry()->getGenericInjecter();
        $genericInjecter->getDistributer()->setPrefixString('Material');
        $genericInjecter->getParameter()->init($args);

        $sqlangInjecter = $this->getRepositpry()->get();
        $records = $store->setSqlangInjecter($sqlangInjecter)->getList();


        foreach ($records as $rows)
        {
            $rows['recipe_weight']  = $this->bizDo->recipe_weight;
            $rows['output_num']     = $this->bizDo->output_num;

            $materialBo = MaterialBO::getInstance();
            $materialBo->init($rows);
            $list[$materialBo->belongId()][] = $materialBo->calc()->get();
        }

        return $list;
    }
}