<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Brand\Cate\Modify;
use App\Network\Legals\Brand\CateLegal;
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
class AppLegal extends CateLegal
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