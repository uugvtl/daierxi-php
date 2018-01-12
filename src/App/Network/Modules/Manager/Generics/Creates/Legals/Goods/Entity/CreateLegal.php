<?php
namespace App\Network\Modules\Manager\Generics\Creates\Legals\Goods\Entity;
use App\Network\Legals\Goods\EntityBaseLegal;
use Phalcon\Validation\Validator\Numericality;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 16:33
 *
 * Class CreateLegal
 * @package App\Network\Modules\Manager\Generics\Creates\Legals\Goods\Entity
 */
class CreateLegal extends EntityBaseLegal
{
    protected function run()
    {
        parent::run();

        $aValidFields = [
            'brand_id', 'supplier_id'
        ];
        $aValidMessage = [
            'message'   => [
                'brand_id'          => $this->t('goods.goods', 'numericality_brand_id'),
                'supplier_id'       => $this->t('goods.goods', 'numericality_supplier_id')
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}