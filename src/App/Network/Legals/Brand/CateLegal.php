<?php
namespace App\Network\Legals\Brand;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 20:35
 *
 * Class CateLegal
 * @package App\Network\Legals\Brand
 */
class CateLegal extends BaseLegal
{
    protected function run()
    {
        $this->validation->add(['brand_type_name', 'brand_type_sortrank'], new PresenceOf([
            'message' => [
                'brand_type_name'       => $this->t('brand_cate', 'presence_brand_type_name'),
            ]
        ]));

        $this->validation->add(['brand_type_sortrank'], new Numericality([
            'message'=>[
                'brand_type_sortrank'      => $this->t('brand_cate', 'numericality_brand_type_sortrank')
            ]
        ]));
    }
}