<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Prop;
use App\Network\Legals\Goods\PropBaseLegal;
use Phalcon\Validation\Validator\Numericality;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 15/1/18
 * Time: 13:30
 *
 * Class ModifyLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Prop
 */
class ModifyLegal extends PropBaseLegal
{
    protected function run()
    {
        $aValidFields = ['prop_id'];
        $aValidMessage = [
            'message'   => [
                'prop_id'     => $this->t('goods.prop', 'numericality_prop_id')
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}