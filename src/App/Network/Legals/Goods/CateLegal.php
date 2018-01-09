<?php
namespace App\Network\Legals\Goods;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 23:03
 *
 * Class CateLegal
 * @package App\Network\Legals\Goods
 */
class CateLegal extends BaseLegal
{
    protected function run()
    {
        $verifyFields = ['cate_name'];
        $verifyMessage = [
            'cate_name'      => $this->t('goods_cate', 'presence_cate_name')
        ];

        $this->validation->add($verifyFields, new PresenceOf([
            'message' => $verifyMessage
        ]));



        $verifyFields = ['parent_id', 'depth', 'sort_order', 'disabled'];
        $verifyMessage=[
            'parent_id'      => $this->t('goods_cate', 'numericality_parent_id'),
            'depth'          => $this->t('goods_cate', 'numericality_depth'),
            'sort_order'     => $this->t('goods_cate', 'numericality_sort_order'),
            'disabled'       => $this->t('goods_cate', 'numericality_disabled')
        ];
        $this->validation->add($verifyFields, new Numericality([
            'message'=>$verifyMessage
        ]));
    }
}