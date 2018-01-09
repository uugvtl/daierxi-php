<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Cate\Modify;
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
class AppLegal extends CateLegal
{
    protected function run()
    {
        parent::run();

        $verifyFields = ['cate_id'];
        $verifyMessage=[
            'cate_id'        => $this->t('goods_cate', 'numericality_cate_id')
        ];
        $this->validation->add($verifyFields, new Numericality([
            'message'=>$verifyMessage
        ]));
    }
}