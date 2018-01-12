<?php
namespace App\Network\Legals\Goods;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 13:59
 *
 * Class EntityLegal
 * @package App\Network\Legals\Goods
 */
class EntityBaseLegal extends BaseLegal
{
    protected function run()
    {

        $aValidFields = [
            'goods_name', 'goods_desc'
        ];
        $aValidMessage = [
            'message'   => [

                'goods_name'        => $this->t('goods.goods', 'presence_goods_name'),
                'goods_desc'        => $this->t('goods.goods', 'presence_goods_desc'),

            ]
        ];

        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));


        $aValidFields = [
            'default_sku', 'one_cate_id', 'two_cate_id', 'three_cate_id', 'rule_id',
            'return_policy', 'sort_order', 'is_retail', 'is_supply', 'goods_channel', 'goods_status'
        ];
        $aValidMessage = [
            'message'   => [
                'default_sku'       => $this->t('goods.goods', 'numericality_default_sku'),

                'one_cate_id'       => $this->t('goods.goods', 'numericality_one_cate_id'),
                'two_cate_id'       => $this->t('goods.goods', 'numericality_two_cate_id'),
                'three_cate_id'     => $this->t('goods.goods', 'numericality_three_cate_id'),
                'rule_id'           => $this->t('goods.goods', 'numericality_rule_id'),

                'return_policy'     => $this->t('goods.goods', 'numericality_return_policy'),
                'sort_order'        => $this->t('goods.goods', 'numericality_sort_order'),
                'is_retail'         => $this->t('goods.goods', 'numericality_is_retail'),
                'is_supply'         => $this->t('goods.goods', 'numericality_is_supply'),
                'goods_channel'     => $this->t('goods.goods', 'numericality_goods_channel'),
                'goods_status'      => $this->t('goods.goods', 'numericality_goods_status')
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));

    }
}