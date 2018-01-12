<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Entity;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 18:14
 *
 * Class UploadLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Entity
 */
class UploadLegal extends BaseLegal
{
    protected function run()
    {
        $aVerifyFields = ['goods_image'];
        $aVerifyMessage = [
            'goods_image'      => $this->t('goods.goods', 'presence_goods_image')
        ];

        $this->validation->add($aVerifyFields, new PresenceOf([
            'message' => $aVerifyMessage
        ]));


        $aVerifyFields = ['goods_id'];
        $aVerifyMessage=[
            'goods_id'        => $this->t('goods.goods', 'numericality_goods_id')
        ];
        $this->validation->add($aVerifyFields, new Numericality([
            'message'=>$aVerifyMessage
        ]));
    }
}