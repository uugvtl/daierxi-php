<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Brand\Entity\Modify;
use App\Network\Legals\Brand\EntityLegal;
use Phalcon\Validation\Validator\Numericality;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:37
 *
 * Class AppLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Brand\Entity\Modify
 */
class AppLegal extends EntityLegal
{
    protected function run()
    {
        parent::run();


        $aValidFields = [
            'brand_id'
        ];

        $aValidMessage = [
            'message'   => [
                'brand_id'          => $this->t('brand', 'numericality_brand_id'),
            ]
        ];

        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}