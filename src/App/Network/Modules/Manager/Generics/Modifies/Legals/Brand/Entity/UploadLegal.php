<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Brand\Entity;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 9/1/18
 * Time: 15:50
 *
 * Class AppLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Brand\Entity\Upload
 */
class UploadLegal extends BaseLegal
{
    protected function run()
    {

        $verifyFields = ['brand_thumb_common'];
        $verifyMessage = [
            'brand_thumb_common'      => $this->t('brand', 'presence_brand_thumb_common')
        ];

        $this->validation->add($verifyFields, new PresenceOf([
            'message' => $verifyMessage
        ]));


        $verifyFields = ['brand_id'];
        $verifyMessage=[
            'brand_id'        => $this->t('brand', 'numericality_brand_id')
        ];
        $this->validation->add($verifyFields, new Numericality([
            'message'=>$verifyMessage
        ]));
    }
}