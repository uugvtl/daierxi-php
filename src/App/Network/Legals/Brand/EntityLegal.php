<?php
namespace App\Network\Legals\Brand;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:30
 *
 * Class EntityLegal
 * @package App\Network\Legals\Brand
 */
class EntityLegal extends BaseLegal
{
    protected function run()
    {
        $aValidFields = [
            'brand_code','brand_name', 'brand_shop_name',
            'brand_company_name', 'channel_code', 'alias_brand_name'
        ];
        $aValidMessage = [
            'message'   => [

                'brand_code'            => $this->t('brand', 'presence_brand_code'),
                'brand_name'            => $this->t('brand', 'presence_brand_name'),
                'brand_shop_name'       => $this->t('brand', 'presence_brand_shop_name'),
                'brand_company_name'    => $this->t('brand', 'presence_brand_company_name'),
                'alias_brand_name'      => $this->t('brand', 'presence_alias_brand_name')

            ]
        ];

        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));

        $aValidFields = [
            'brand_tag', 'brand_rank', 'brand_type_id',
            'is_personal', 'is_supply', 'is_remove'
        ];

        $aValidMessage = [
            'message'   => [
                'brand_tag'         => $this->t('brand', 'numericality_brand_tag'),
                'brand_rank'        => $this->t('brand', 'numericality_brand_rank'),
                'brand_type_id'     => $this->t('brand', 'numericality_brand_type_id'),
                'is_personal'       => $this->t('brand', 'numericality_is_personal'),
                'is_supply'         => $this->t('brand', 'numericality_is_supply'),
                'is_remove'         => $this->t('brand', 'numericality_is_remove')

            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}