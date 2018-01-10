<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 10/1/18
 * Time: 18:51
 */

namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Cate\Upload;


use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

class AppLegal extends BaseLegal
{
    protected function run()
    {
        $aVerifyFields = ['cate_thumb'];
        $aVerifyMessage = [
            'cate_thumb'      => $this->t('goods_cate', 'presence_cate_thumb')
        ];

        $this->validation->add($aVerifyFields, new PresenceOf([
            'message' => $aVerifyMessage
        ]));


        $aVerifyFields = ['cate_id'];
        $aVerifyMessage=[
            'cate_id'        => $this->t('goods_cate', 'numericality_cate_id')
        ];
        $this->validation->add($aVerifyFields, new Numericality([
            'message'=>$aVerifyMessage
        ]));
    }

}