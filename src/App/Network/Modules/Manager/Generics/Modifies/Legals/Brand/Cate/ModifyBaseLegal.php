<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Brand\Cate;
use App\Network\Legals\Brand\CateBaseLegal;
use Phalcon\Validation\Validator\Numericality;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 01:33
 *
 * Class AppLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Brand\Cate\Modify
 */
class ModifyBaseLegal extends CateBaseLegal
{
    protected function run()
    {
        parent::run();

        $this->validation->add(['brand_type_id'], new Numericality([
            'message'=>[
                'brand_type_id'      => $this->t('brand', 'numericality_brand_type_id')
            ]
        ]));
    }
}