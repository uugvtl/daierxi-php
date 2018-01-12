<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Entity;
use App\Network\Legals\Goods\EntityBaseLegal;
use Phalcon\Validation\Validator\Numericality;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 16:57
 *
 * Class ModifyLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Goods\Entity
 */
class ModifyLegal extends EntityBaseLegal
{
    protected function run()
    {
        parent::run();

        $aValidFields = [
            'goods_id'
        ];
        $aValidMessage = [
            'message'   => [
                'goods_id'          => $this->t('goods.goods', 'numericality_goods_id')
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}