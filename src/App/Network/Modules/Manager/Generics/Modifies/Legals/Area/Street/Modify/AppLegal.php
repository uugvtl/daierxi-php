<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Legals\Area\Street\Modify;
use App\Network\Legals\Area\StreetLegal;
use Phalcon\Validation\Validator\Numericality;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 16:35
 *
 * Class AppLegal
 * @package App\Network\Modules\Manager\Generics\Modifies\Legals\Area\Street\Modify
 */
class AppLegal extends StreetLegal
{
    protected function run()
    {
        parent::run();

        $aValidFields = ['street_id'];
        $aValidMessage = [
            'message'   => [
                'street_id'     => $this->t('area_street', 'numericality_street_id')
            ]
        ];
        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}