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
        $verifyFields = ['goods_image'];
        $verifyMessage = [
            'goods_image'      => $this->t('goods.goods', 'presence_goods_image')
        ];

        $this->validation->add($verifyFields, new PresenceOf([
            'message' => $verifyMessage
        ]));


        $verifyFields = ['goods_id'];
        $verifyMessage=[
            'goods_id'        => $this->t('goods.goods', 'numericality_goods_id')
        ];
        $this->validation->add($verifyFields, new Numericality([
            'message'=>$verifyMessage
        ]));
    }
}