<?php
namespace App\Network\Legals\Goods;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 13:52
 *
 * Class RecipeBaseLegal
 * @package App\Network\Legals\Goods
 */
class RecipeBaseLegal extends BaseLegal
{
    protected function run()
    {
        $aValidFields = ['goods_id', 'deionized_water'];
        $aValidMessage = [
            'message'   => [
                'goods_id'          => $this->t('goods.recipe', 'numericality_goods_id'),
                'deionized_water'   => $this->t('goods.recipe', 'numericality_deionized_water')
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));

        $aValidFields = ['sku_material_rate'];
        $aValidMessage = [
            'message'   => [
                'sku_material_rate'    => $this->t('goods.recipe', 'presence_sku_material_rate')
            ]
        ];

        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));
    }
}