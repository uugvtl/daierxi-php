<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Cate;
use App\Network\Legals\Goods\CateLegal;
use Phalcon\Validation\Validator\Numericality;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 00:32
 *
 * Class AppLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Cate\Modify
 */
class ModifyLegal extends CateLegal
{
    protected function run()
    {
        parent::run();

        $aVerifyFields = ['cate_id'];
        $aVerifyMessage=[
            'cate_id'        => $this->t('goods_cate', 'numericality_cate_id')
        ];
        $this->validation->add($aVerifyFields, new Numericality([
            'message'=>$aVerifyMessage
        ]));
    }
}