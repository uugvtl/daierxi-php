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
class EntityBaseLegal extends BaseLegal
{
    protected function run()
    {
        $aValidFields = [
            'brand_symbol','brand_name','company_name', 'alias_name'
        ];
        $aValidMessage = [
            'message'   => [
                'brand_symbol'      => $this->t('brand', 'presence_brand_symbol'),
                'brand_name'        => $this->t('brand', 'presence_brand_name'),
                'company_name'      => $this->t('brand', 'presence_company_name'),
                'alias_name'        => $this->t('brand', 'presence_alias_name')

            ]
        ];

        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));

        $aValidFields = [
            'brand_rank',  'is_remove'
        ];

        $aValidMessage = [
            'message'   => [
                'brand_rank'        => $this->t('brand', 'numericality_brand_rank'),
                'is_remove'         => $this->t('brand', 'numericality_is_remove')

            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}