<?php
namespace App\Network\Legals\Goods;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 12:53
 *
 * Class PropBaseLegal
 * @package App\Network\Legals\Goods
 */
class PropBaseLegal extends BaseLegal
{
    protected function run()
    {
        $aValidFields = ['prop_name', 'brand_ids'];
        $aValidMessage = [
            'message'   => [
                'prop_name'     => $this->t('goods.prop', 'presence_prop_name'),
            ]
        ];

        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));
    }
}