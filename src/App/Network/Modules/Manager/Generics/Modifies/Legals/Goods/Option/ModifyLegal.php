<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Option;
use App\Network\Legals\Goods\OptionBaseLegal;
use Phalcon\Validation\Validator\Numericality;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 14/1/18
 * Time: 11:19
 *
 * Class ModifyLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Option
 */
class ModifyLegal extends OptionBaseLegal
{
    protected function run()
    {
        parent::run();

        $aValidFields = ['option_id'];
        $aValidMessage = [
            'message'   => [
                'option_id'   => $this->t('goods.option', 'numericality_option_id')
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}