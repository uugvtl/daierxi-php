<?php
namespace App\Network\Legals\Goods;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 19:20
 *
 * Class OptionBaseLegal
 * @package App\Network\Legals\Goods
 */
class OptionBaseLegal extends BaseLegal
{
    protected function run()
    {
        $aValidFields = ['text'];
        $aValidMessage = [
            'message'   => [
                'text'     => $this->t('goods.option', 'presenceof_text')
            ]
        ];
        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));


        $aValidFields = ['prop_id'];
        $aValidMessage = [
            'message'   => [
                'prop_id'     => $this->t('goods.prop', 'numericality_prop_id')
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}